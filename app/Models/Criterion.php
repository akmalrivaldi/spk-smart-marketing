<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Criterion extends Model
{
    protected $fillable = [
        'code',
        'name',
        'type',
        'weight',
        'description',
    ];

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }

    public function getNormalizedWeightAttribute(): float
    {
        $totalWeight = self::sum('weight');

        if ($totalWeight <= 0) {
            return 0;
        }

        return $this->weight / $totalWeight;
    }
}