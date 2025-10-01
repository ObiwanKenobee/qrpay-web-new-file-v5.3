<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use App\Services\QRService;
use App\Services\InsuranceService;
use App\Services\CreditService;

class PaymentService
{
    protected $qrService;
    protected $insuranceService;
    protected $creditService;

    public function __construct(
        QRService $qrService,
        InsuranceService $insuranceService,
        CreditService $creditService
    ) {
        $this->qrService = $qrService;
        $this->insuranceService = $insuranceService;
        $this->creditService = $creditService;
    }

    public function processTransaction(array $data): Transaction
    {
        return DB::transaction(function () use ($data) {
            // Create the main transaction
            $transaction = Transaction::create([
                'sender_wallet_id' => $data['sender_wallet_id'],
                'receiver_wallet_id' => $data['receiver_wallet_id'],
                'amount' => $data['amount'],
                'currency' => $data['currency'],
                'type' => $data['type'] ?? 'standard',
                'status' => 'pending',
                'ethical_tags' => $data['ethical_tags'] ?? [],
                'metadata' => $data['metadata'] ?? []
            ]);

            // Process micro-insurance premium if enabled
            if ($data['insurance_enabled'] ?? false) {
                $this->insuranceService->processPremium($transaction);
            }

            // Generate regenerative credits for impact
            if ($data['generate_credits'] ?? false) {
                $this->creditService->generateCredits($transaction);
            }

            // Update wallet balances
            $this->updateWalletBalances($transaction);

            // Generate QR code if needed
            if ($data['generate_qr'] ?? false) {
                $qrCode = $this->qrService->generateForTransaction($transaction);
                $transaction->update(['qr_code' => $qrCode]);
            }

            return $transaction;
        });
    }

    protected function updateWalletBalances(Transaction $transaction): void
    {
        $senderWallet = Wallet::findOrFail($transaction->sender_wallet_id);
        $receiverWallet = Wallet::findOrFail($transaction->receiver_wallet_id);

        if ($senderWallet->balance < $transaction->amount) {
            throw new \Exception('Insufficient funds');
        }

        $senderWallet->decrement('balance', $transaction->amount);
        $receiverWallet->increment('balance', $transaction->amount);
    }

    public function validateTransaction(array $data): bool
    {
        // Validate currency match
        $senderWallet = Wallet::findOrFail($data['sender_wallet_id']);
        $receiverWallet = Wallet::findOrFail($data['receiver_wallet_id']);

        if ($senderWallet->currency !== $receiverWallet->currency) {
            throw new \Exception('Currency mismatch between wallets');
        }

        // Validate sufficient balance
        if ($senderWallet->balance < $data['amount']) {
            throw new \Exception('Insufficient funds');
        }

        return true;
    }
}