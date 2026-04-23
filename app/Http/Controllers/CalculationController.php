<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criterion;
use App\Models\Score;

class CalculationController extends Controller
{
    public function index()
    {
        $criteria = Criterion::orderBy('code')->get();
        $alternatives = Alternative::orderBy('code')->get();
        $scores = Score::with(['alternative', 'criterion'])->get();

        if ($criteria->isEmpty() || $alternatives->isEmpty()) {
            return view('calculations.index', [
                'criteria' => $criteria,
                'alternatives' => $alternatives,
                'rawMatrix' => [],
                'normalizedWeights' => [],
                'minMaxValues' => [],
                'utilityMatrix' => [],
                'results' => collect(),
                'totalWeight' => 0,
                'isComplete' => false,
                'message' => 'Data kriteria atau alternatif belum lengkap.',
            ]);
        }

        $scoreMap = [];
        foreach ($scores as $score) {
            $scoreMap[$score->alternative_id][$score->criterion_id] = (float) $score->value;
        }

        $isComplete = true;
        foreach ($alternatives as $alternative) {
            foreach ($criteria as $criterion) {
                if (!isset($scoreMap[$alternative->id][$criterion->id])) {
                    $isComplete = false;
                    break 2;
                }
            }
        }

        if (!$isComplete) {
            return view('calculations.index', [
                'criteria' => $criteria,
                'alternatives' => $alternatives,
                'rawMatrix' => [],
                'normalizedWeights' => [],
                'minMaxValues' => [],
                'utilityMatrix' => [],
                'results' => collect(),
                'totalWeight' => $criteria->sum('weight'),
                'isComplete' => false,
                'message' => 'Penilaian belum lengkap. Silakan isi semua nilai alternatif pada setiap kriteria.',
            ]);
        }

        $totalWeight = $criteria->sum('weight');

        $normalizedWeights = [];
        foreach ($criteria as $criterion) {
            $normalizedWeights[$criterion->id] = $totalWeight > 0
                ? ((float) $criterion->weight / (float) $totalWeight)
                : 0;
        }

        $rawMatrix = [];
        foreach ($alternatives as $alternative) {
            foreach ($criteria as $criterion) {
                $rawMatrix[$alternative->id][$criterion->id] = $scoreMap[$alternative->id][$criterion->id];
            }
        }

        $minMaxValues = [];
        foreach ($criteria as $criterion) {
            $values = [];
            foreach ($alternatives as $alternative) {
                $values[] = $rawMatrix[$alternative->id][$criterion->id];
            }

            $minMaxValues[$criterion->id] = [
                'min' => min($values),
                'max' => max($values),
            ];
        }

        $utilityMatrix = [];
        foreach ($alternatives as $alternative) {
            foreach ($criteria as $criterion) {
                $value = $rawMatrix[$alternative->id][$criterion->id];
                $min = $minMaxValues[$criterion->id]['min'];
                $max = $minMaxValues[$criterion->id]['max'];

                if ($max == $min) {
                    $utility = 1;
                } else {
                    if ($criterion->type === 'benefit') {
                        $utility = ($value - $min) / ($max - $min);
                    } else {
                        $utility = ($max - $value) / ($max - $min);
                    }
                }

                $utilityMatrix[$alternative->id][$criterion->id] = $utility;
            }
        }

        $results = collect();
        foreach ($alternatives as $alternative) {
            $totalScore = 0;
            $detail = [];

            foreach ($criteria as $criterion) {
                $weight = $normalizedWeights[$criterion->id];
                $utility = $utilityMatrix[$alternative->id][$criterion->id];
                $weightedValue = $weight * $utility;

                $detail[] = [
                    'criterion_id' => $criterion->id,
                    'criterion_code' => $criterion->code,
                    'criterion_name' => $criterion->name,
                    'weight' => $weight,
                    'utility' => $utility,
                    'weighted_value' => $weightedValue,
                ];

                $totalScore += $weightedValue;
            }

            $results->push([
                'alternative_id' => $alternative->id,
                'alternative_code' => $alternative->code,
                'alternative_name' => $alternative->name,
                'score' => $totalScore,
                'detail' => $detail,
            ]);
        }

        $results = $results->sortByDesc('score')->values();

        $rank = 1;
        $results = $results->map(function ($item) use (&$rank) {
            $item['rank'] = $rank++;
            return $item;
        });

        return view('calculations.index', [
            'criteria' => $criteria,
            'alternatives' => $alternatives,
            'rawMatrix' => $rawMatrix,
            'normalizedWeights' => $normalizedWeights,
            'minMaxValues' => $minMaxValues,
            'utilityMatrix' => $utilityMatrix,
            'results' => $results,
            'totalWeight' => $totalWeight,
            'isComplete' => true,
            'message' => null,
        ]);
    }
}