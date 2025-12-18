<?php


namespace App\Http\Controllers;

use App\Models\LoanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoanController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $loans = LoanModel::where('user_id', $userId)->latest()->get();
        return view('loans.index', compact('loans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'loan_name' => 'required|string|max:100',
            'role' => 'required|in:borrower,lender',
            'person_name' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0.01',
            'due_date' => 'required|date',
            'short_description' => 'required|string|max:255',
        ]);

        $validated['user_id'] = Auth::id(); 
        $validated['paid'] = 0;

        LoanModel::create($validated);

        return redirect()->route('loans.index')
            ->with('success', 'Loan created successfully!');
    }

    public function show(LoanModel $loan)
    {
        $userId = Auth::id();

        // Authorization
        if ($loan->user_id !== $userId) {
            abort(403);
        }

        return view('loans.show', compact('loan'));
    }

    public function paymentForm(LoanModel $loan)
    {
        $userId = Auth::id();

        if ($loan->user_id !== $userId) {
            abort(403);
        }

        $remaining = $loan->amount - $loan->paid;
        return view('loans.payment', compact('loan', 'remaining'));
    }

    

    public function recordPayment(Request $request, LoanModel $loan)
    {
        $userId = Auth::id();

        if ($loan->user_id !== $userId) {
            abort(403);
        }

        $request->validate([
            'amount' => 'required|numeric|min:0.01|max:' . ($loan->amount - $loan->paid)
        ]);

        $loan->paid += $request->amount;
        $loan->save();

        return redirect()->route('loans.show', $loan)
            ->with('success', 'Payment recorded successfully!');
    }

    public function destroy(LoanModel $loan)
    {
        $userId = Auth::id();

        if ($loan->user_id !== $userId) {
            abort(403);
        }

        $loan->delete();

        return redirect()->route('loans.index')
            ->with('success', 'Loan deleted successfully!');
    }

    public function getRouteKeyName()
    {
        return 'loan_id';
    }
}
