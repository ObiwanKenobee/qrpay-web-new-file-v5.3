<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EthicalImpactMetric;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EthicalImpactMetricController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $metrics = EthicalImpactMetric::query()
            ->when($request->wallet_id, function($query) use ($request) {
                return $query->where('wallet_id', $request->wallet_id);
            })
            ->when($request->metric_type, function($query) use ($request) {
                return $query->where('metric_type', $request->metric_type);
            })
            ->get();

        return response()->json(['data' => $metrics]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'metric_type' => 'required|string|in:environmental,social,governance',
            'value' => 'required|numeric',
            'unit' => 'required|string',
            'verification_data' => 'nullable|array'
        ]);

        $metric = EthicalImpactMetric::create($validated);
        
        return response()->json(['data' => $metric], 201);
    }

    public function show(EthicalImpactMetric $metric): JsonResponse
    {
        return response()->json(['data' => $metric]);
    }

    public function update(Request $request, EthicalImpactMetric $metric): JsonResponse
    {
        $this->authorize('update', $metric);
        
        $validated = $request->validate([
            'value' => 'numeric',
            'unit' => 'string',
            'verification_data' => 'array'
        ]);

        $metric->update($validated);
        
        return response()->json(['data' => $metric]);
    }
}