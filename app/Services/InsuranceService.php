<?php

namespace App\Services;

use App\Models\InsurancePolicy;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class InsuranceService
{
    protected $premiumPercentage = 0.01; // 1% of transaction amount

    public function processPremium(Transaction $transaction): InsurancePolicy
    {
        return DB::transaction(function () use ($transaction) {
            $premium = $transaction->amount * $this->premiumPercentage;

            return InsurancePolicy::create([
                'user_id' => $transaction->sender_wallet->user_id,
                'transaction_id' => $transaction->id,
                'premium_amount' => $premium,
                'coverage_amount' => $premium * 100, // 100x coverage
                'currency' => $transaction->currency,
                'status' => 'active',
                'start_date' => now(),
                'end_date' => now()->addMonths(1),
                'type' => 'transaction-based',
                'metadata' => [
                    'transaction_type' => $transaction->type,
                    'ethical_tags' => $transaction->ethical_tags
                ]
            ]);
        });
    }

    public function calculateCoverage(InsurancePolicy $policy): array
    {
        return [
            'premium_paid' => $policy->premium_amount,
            'coverage_amount' => $policy->coverage_amount,
            'remaining_days' => now()->diffInDays($policy->end_date),
            'is_active' => $policy->status === 'active' && now()->lt($policy->end_date)
        ];
    }

    public function processClaim(InsurancePolicy $policy, array $claimData): bool
    {
        if (!$this->validateClaim($policy, $claimData)) {
            return false;
        }

        DB::transaction(function () use ($policy, $claimData) {
            $policy->update([
                'status' => 'claimed',
                'claim_date' => now(),
                'claim_amount' => $claimData['amount'],
                'claim_reason' => $claimData['reason'],
                'claim_evidence' => $claimData['evidence'] ?? null
            ]);

            // Process payout to user's wallet
            $wallet = $policy->user->wallets()
                ->where('currency', $policy->currency)
                ->where('is_primary', true)
                ->firstOrFail();

            $wallet->increment('balance', $claimData['amount']);
        });

        return true;
    }

    protected function validateClaim(InsurancePolicy $policy, array $claimData): bool
    {
        if ($policy->status !== 'active') {
            throw new \Exception('Policy is not active');
        }

        if (now()->gt($policy->end_date)) {
            throw new \Exception('Policy has expired');
        }

        if ($claimData['amount'] > $policy->coverage_amount) {
            throw new \Exception('Claim amount exceeds coverage');
        }

        return true;
    }
}