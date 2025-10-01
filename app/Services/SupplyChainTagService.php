<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\SupplyChainTag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SupplyChainTagService
{
    public function addTag($data)
    {
        return DB::transaction(function () use ($data) {
            $tag = SupplyChainTag::create([
                'transaction_id' => $data['transaction_id'],
                'name' => $data['name'],
                'value' => $data['value'],
                'category' => $data['category'] ?? null,
                'verification_level' => $data['verification_level'] ?? 'pending',
                'verified_by' => Auth::id(),
                'verification_date' => now(),
                'metadata' => $data['metadata'] ?? [],
                'parent_id' => $data['parent_id'] ?? null
            ]);

            return $tag;
        });
    }

    public function verifyTag($tagId, $verificationLevel)
    {
        $tag = SupplyChainTag::findOrFail($tagId);
        
        $tag->update([
            'verification_level' => $verificationLevel,
            'verified_by' => Auth::id(),
            'verification_date' => now()
        ]);

        return $tag;
    }

    public function getTransactionTags($transactionId)
    {
        return SupplyChainTag::where('transaction_id', $transactionId)
            ->with(['verifier', 'children'])
            ->get();
    }

    public function getTagsByCategory($category)
    {
        return SupplyChainTag::where('category', $category)
            ->with(['transaction', 'verifier'])
            ->get();
    }

    public function updateTag($tagId, $data)
    {
        $tag = SupplyChainTag::findOrFail($tagId);
        
        $tag->update([
            'name' => $data['name'] ?? $tag->name,
            'value' => $data['value'] ?? $tag->value,
            'category' => $data['category'] ?? $tag->category,
            'metadata' => array_merge($tag->metadata ?? [], $data['metadata'] ?? [])
        ]);

        return $tag;
    }

    public function deleteTag($tagId)
    {
        $tag = SupplyChainTag::findOrFail($tagId);
        
        // First delete all child tags
        $tag->children()->delete();
        
        // Then delete the tag itself
        return $tag->delete();
    }
}