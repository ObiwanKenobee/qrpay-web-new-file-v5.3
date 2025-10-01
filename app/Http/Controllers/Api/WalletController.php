<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WalletController extends Controller
{
    public function index(): JsonResponse
    {
        $wallets = auth()->user()->wallets;
        return response()->json(['data' => $wallets]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'currency' => 'required|string|max:10',
            'type' => 'required|string|in:standard,impact,community',
            'is_primary' => 'boolean',
            'settings' => 'nullable|array'
        ]);

        $wallet = auth()->user()->wallets()->create($validated);
        
        return response()->json(['data' => $wallet], 201);
    }

    public function show(Wallet $wallet): JsonResponse
    {
        $this->authorize('view', $wallet);
        return response()->json(['data' => $wallet->load([
            'ethicalImpactMetrics',
            'communityBonds'
        ])]);
    }

    public function update(Request $request, Wallet $wallet): JsonResponse
    {
        $this->authorize('update', $wallet);
        
        $validated = $request->validate([
            'status' => 'string|in:active,inactive,frozen',
            'is_primary' => 'boolean',
            'settings' => 'array'
        ]);

        $wallet->update($validated);
        
        return response()->json(['data' => $wallet]);
    }

    public function destroy(Wallet $wallet): JsonResponse
    {
        $this->authorize('delete', $wallet);
        
        $wallet->delete();
        
        return response()->json(null, 204);
    }
}