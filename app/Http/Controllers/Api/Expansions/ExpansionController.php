<?php

namespace App\Http\Controllers\Api\Expansions;

use App\Http\Controllers\Controller;
use App\Models\ExpansionProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExpansionController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'type' => 'required|string|in:personal,business,enterprise,company,developer',
            'settings' => 'nullable|array',
            'features' => 'nullable|array'
        ]);

        $profile = ExpansionProfile::create([
            'user_id' => auth()->id(),
            'type' => $validated['type'],
            'settings' => $validated['settings'] ?? [],
            'features' => $validated['features'] ?? []
        ]);

        return response()->json(['data' => $profile], 201);
    }

    public function show(ExpansionProfile $profile): JsonResponse
    {
        $this->authorize('view', $profile);
        return response()->json(['data' => $profile]);
    }

    public function update(Request $request, ExpansionProfile $profile): JsonResponse
    {
        $this->authorize('update', $profile);

        $validated = $request->validate([
            'settings' => 'array',
            'features' => 'array',
            'status' => 'string|in:active,inactive'
        ]);

        $profile->update($validated);

        return response()->json(['data' => $profile]);
    }

    public function delete(ExpansionProfile $profile): JsonResponse
    {
        $this->authorize('delete', $profile);
        $profile->delete();
        return response()->json(null, 204);
    }
}