<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criterion;
use App\Models\Score;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCriteria = Criterion::count();
        $totalAlternatives = Alternative::count();
        $totalScores = Score::count();

        $expectedScores = $totalCriteria * $totalAlternatives;
        $completionPercentage = $expectedScores > 0
            ? round(($totalScores / $expectedScores) * 100, 2)
            : 0;

        return view('dashboard', compact(
            'totalCriteria',
            'totalAlternatives',
            'totalScores',
            'expectedScores',
            'completionPercentage'
        ));
    }
}