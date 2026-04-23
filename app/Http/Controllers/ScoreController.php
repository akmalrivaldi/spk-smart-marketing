<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criterion;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function index()
    {
        $alternatives = Alternative::orderBy('code')->get();
        $criteria = Criterion::orderBy('code')->get();
        $scores = Score::all()->keyBy(function ($item) {
            return $item->alternative_id . '-' . $item->criterion_id;
        });

        return view('scores.index', compact('alternatives', 'criteria', 'scores'));
    }

    public function store(Request $request)
    {
        $alternatives = Alternative::orderBy('code')->get();
        $criteria = Criterion::orderBy('code')->get();

        if ($alternatives->isEmpty()) {
            return redirect()
                ->route('scores.index')
                ->with('error', 'Data alternatif belum ada. Silakan tambah alternatif terlebih dahulu.');
        }

        if ($criteria->isEmpty()) {
            return redirect()
                ->route('scores.index')
                ->with('error', 'Data kriteria belum ada. Silakan tambah kriteria terlebih dahulu.');
        }

        $validated = $request->validate([
            'scores' => ['required', 'array'],
            'scores.*.*' => ['required', 'numeric', 'min:0'],
        ], [
            'scores.required' => 'Data penilaian wajib diisi.',
            'scores.*.*.required' => 'Semua nilai penilaian wajib diisi.',
            'scores.*.*.numeric' => 'Nilai penilaian harus berupa angka.',
            'scores.*.*.min' => 'Nilai penilaian minimal 0.',
        ]);

        foreach ($validated['scores'] as $alternativeId => $criterionScores) {
            foreach ($criterionScores as $criterionId => $value) {
                Score::updateOrCreate(
                    [
                        'alternative_id' => $alternativeId,
                        'criterion_id' => $criterionId,
                    ],
                    [
                        'value' => $value,
                    ]
                );
            }
        }

        return redirect()
            ->route('scores.index')
            ->with('success', 'Data penilaian berhasil disimpan.');
    }
}