<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\RegenerativeCredit;
use Illuminate\Support\Facades\DB;

class CreditService
{
    public function generateCredits(Transaction $transaction): RegenerativeCredit
    {
        // Calculate impact score based on ethical tags and transaction amount
        $impactScore = $this->calculateImpactScore($transaction);

        return DB::transaction(function () use ($transaction, $impactScore) {
            return RegenerativeCredit::create([
                'user_id' => $transaction->sender_wallet->user_id,
                'transaction_id' => $transaction->id,
                'amount' => $impactScore * $transaction->amount,
                'impact_score' => $impactScore,
                'type' => $this->determineImpactType($transaction->ethical_tags),
                'status' => 'active',
                'verification_data' => [
                    'transaction_hash' => hash('sha256', $transaction->id . time()),
                    'ethical_tags' => $transaction->ethical_tags,
                    'impact_calculation' => [
                        'base_amount' => $transaction->amount,
                        'multiplier' => $impactScore,
                        'factors' => $this->getImpactFactors($transaction->ethical_tags)
                    ]
                ]
            ]);
        });
    }

    protected function calculateImpactScore(Transaction $transaction): float
    {
        $baseScore = 1.0;
        $ethicalTags = $transaction->ethical_tags ?? [];

        $impactFactors = [
            'environmental' => 1.5,
            'social' => 1.3,
            'community' => 1.2,
            'sustainable' => 1.4,
            'renewable' => 1.6
        ];

        foreach ($ethicalTags as $tag) {
            if (isset($impactFactors[$tag])) {
                $baseScore *= $impactFactors[$tag];
            }
        }

        return round($baseScore, 2);
    }

    protected function determineImpactType(array $ethicalTags): string
    {
        $typeMapping = [
            'environmental' => 'eco',
            'social' => 'social',
            'community' => 'community',
            'sustainable' => 'sustainability',
            'renewable' => 'renewable'
        ];

        foreach ($ethicalTags as $tag) {
            if (isset($typeMapping[$tag])) {
                return $typeMapping[$tag];
            }
        }

        return 'general';
    }

    protected function getImpactFactors(array $ethicalTags): array
    {
        $factors = [];
        
        foreach ($ethicalTags as $tag) {
            $factors[$tag] = [
                'weight' => $this->getFactorWeight($tag),
                'category' => $this->getFactorCategory($tag)
            ];
        }

        return $factors;
    }

    protected function getFactorWeight(string $tag): float
    {
        $weights = [
            'environmental' => 1.5,
            'social' => 1.3,
            'community' => 1.2,
            'sustainable' => 1.4,
            'renewable' => 1.6,
            'default' => 1.0
        ];

        return $weights[$tag] ?? $weights['default'];
    }

    protected function getFactorCategory(string $tag): string
    {
        $categories = [
            'environmental' => 'Environmental Impact',
            'social' => 'Social Impact',
            'community' => 'Community Development',
            'sustainable' => 'Sustainability',
            'renewable' => 'Renewable Resources',
            'default' => 'General Impact'
        ];

        return $categories[$tag] ?? $categories['default'];
    }
}
