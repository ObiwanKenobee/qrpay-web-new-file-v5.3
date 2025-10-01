<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    private $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index(): JsonResponse
    {
        $transactions = auth()->user()->transactions;
        return response()->json(['data' => $transactions]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'receiver_wallet_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|string|max:10',
            'is_offline' => 'boolean',
            'ethical_tags' => 'nullable|array',
            'metadata' => 'nullable|array'
        ]);

        $transaction = $this->transactionService->createTransaction(
            auth()->user()->wallet,
            $validated
        );
        
        return response()->json(['data' => $transaction], 201);
    }

    public function show(Transaction $transaction): JsonResponse
    {
        $this->authorize('view', $transaction);
        
        return response()->json(['data' => $transaction->load([
            'verificationRecord',
            'senderWallet',
            'receiverWallet'
        ])]);
    }

    public function verifyQR(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'qr_hash' => 'required|string'
        ]);

        $transaction = $this->transactionService->verifyQRTransaction($validated['qr_hash']);
        
        return response()->json(['data' => $transaction]);
    }
}