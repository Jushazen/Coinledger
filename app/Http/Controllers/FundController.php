<?php

// app/Http/Controllers/FundController.php

namespace App\Http\Controllers;

use App\Models\FundModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FundController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $funds = FundModel::where('user_id', $userId)->latest()->get();
        return view('funds.index', compact('funds'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fund_name' => 'required|string|max:100',
            'your_contribution' => 'required|numeric|min:0.01',
            'contributed_on' => 'required|date',
            'short_description' => 'required|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['collected'] = $validated['your_contribution'];
        $validated['status'] = 'active';

        FundModel::create($validated);

        return redirect()->route('funds.index')
            ->with('success', 'Fund created successfully!');
    }

    public function show(FundModel $fund)
    {
        $userId = Auth::id();

        if ($fund->user_id !== $userId) {
            abort(403);
        }

        return view('funds.show', compact('fund'));
    }

    public function addContributionForm(FundModel $fund)
    {
        $userId = Auth::id();

        if ($fund->user_id !== $userId) {
            abort(403);
        }

        return view('funds.payment', compact('fund'));
    }

    public function addContribution(Request $request, FundModel $fund)
    {
        $userId = Auth::id();

        if ($fund->user_id !== $userId) {
            abort(403);
        }

        $request->validate([
            'amount' => 'required|numeric|min:0.01'
        ]);

        $fund->your_contribution += $request->amount;
        $fund->collected += $request->amount;
        $fund->save();

        return redirect()->route('funds.show', $fund)
            ->with('success', 'Contribution added successfully!');
    }

    public function destroy(FundModel $fund)
    {
        $userId = Auth::id();

        if ($fund->user_id !== $userId) {
            abort(403);
        }

        $fund->delete();

        return redirect()->route('funds.index')
            ->with('success', 'Fund deleted successfully!');
    }
}
