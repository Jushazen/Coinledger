<?php

namespace App\Http\Controllers;

use App\Models\LoanModel;
use App\Models\SavingModel;
use App\Models\FundModel; // Make sure you have this model
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Get all loans, savings, and funds for summary
        $loans = LoanModel::where('user_id', $userId)->get();
        $savings = SavingModel::where('user_id', $userId)->get();
        $funds = FundModel::where('user_id', $userId)->get(); // Adjust based on your funds table

        $recentLoans = LoanModel::where('user_id', $userId)
            ->latest()
            ->take(1)
            ->get();

        $recentSavings = SavingModel::where('user_id', $userId)
            ->latest()
            ->take(1)
            ->get();

        $recentFunds = FundModel::where('user_id', $userId)
            ->latest()
            ->take(1)
            ->get();

        return view('home.index', compact(
            'loans',
            'savings',
            'funds',
            'recentLoans',
            'recentSavings',
            'recentFunds'
        ));
    }
}
