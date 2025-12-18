<?php

namespace App\Http\Controllers;

use App\Models\SavingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavingController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $savings = SavingModel::where('user_id', $userId)->latest()->get();
        return view('savings.index', compact('savings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'saving_name' => 'required|string|max:100',
            'monthly' => 'required|numeric|min:0.01',
            'target_amount' => 'required|numeric|min:0.01', // Added
            'target_date' => 'required|date',
            'short_description' => 'required|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['saved'] = 0;
        $validated['status'] = 'active';

        SavingModel::create($validated);

        return redirect()->route('savings.index')
            ->with('success', 'Saving goal created successfully!');
    }

    public function show(SavingModel $saving)
    {
        $userId = Auth::id();

        if ($saving->user_id !== $userId) {
            abort(403);
        }

        return view('savings.show', compact('saving'));
    }

    public function addAmountForm(SavingModel $saving)
    {
        $userId = Auth::id();

        if ($saving->user_id !== $userId) {
            abort(403);
        }

        return view('savings.payment', compact('saving'));
    }

    public function addAmount(Request $request, SavingModel $saving)
    {
        $userId = Auth::id();

        if ($saving->user_id !== $userId) {
            abort(403);
        }

        $request->validate([
            'amount' => 'required|numeric|min:0.01'
        ]);

        $saving->saved += $request->amount;
        $saving->save();

        return redirect()->route('savings.show', $saving)
            ->with('success', 'Amount added successfully!');
    }

    public function destroy(SavingModel $saving)
    {
        $userId = Auth::id();

        if ($saving->user_id !== $userId) {
            abort(403);
        }

        $saving->delete();

        return redirect()->route('savings.index')
            ->with('success', 'Saving goal deleted successfully!');
    }
}