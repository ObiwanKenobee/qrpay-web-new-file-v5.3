<?php

namespace App\Http\Controllers;

use App\Services\SupplyChainTagService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplyChainTagController extends Controller
{
    protected $supplyChainTagService;

    public function __construct(SupplyChainTagService $supplyChainTagService)
    {
        $this->supplyChainTagService = $supplyChainTagService;
        $this->middleware('validate.supply.chain.tag')->except(['index', 'show']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required|exists:transactions,id',
            'name' => 'required|string|max:255',
            'value' => 'required|string',
            'category' => 'nullable|string|max:100',
            'verification_level' => 'nullable|string|in:pending,verified,rejected',
            'metadata' => 'nullable|array',
            'parent_id' => 'nullable|exists:supply_chain_tags,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $tag = $this->supplyChainTagService->addTag($request->all());

        return response()->json($tag, 201);
    }

    public function show($id)
    {
        $tag = $this->supplyChainTagService->getTransactionTags($id);
        return response()->json($tag);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'value' => 'sometimes|string',
            'category' => 'nullable|string|max:100',
            'metadata' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $tag = $this->supplyChainTagService->updateTag($id, $request->all());

        return response()->json($tag);
    }

    public function verify(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'verification_level' => 'required|string|in:verified,rejected'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $tag = $this->supplyChainTagService->verifyTag($id, $request->verification_level);

        return response()->json($tag);
    }

    public function destroy($id)
    {
        $this->supplyChainTagService->deleteTag($id);
        return response()->json(null, 204);
    }

    public function byCategory($category)
    {
        $tags = $this->supplyChainTagService->getTagsByCategory($category);
        return response()->json($tags);
    }
}