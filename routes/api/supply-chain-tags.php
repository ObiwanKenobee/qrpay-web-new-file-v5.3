<?php

use App\Http\Controllers\SupplyChainTagController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('supply-chain-tags')->group(function () {
        // Get tags for a transaction
        Route::get('/{transaction_id}', [SupplyChainTagController::class, 'show']);
        
        // Get tags by category
        Route::get('/category/{category}', [SupplyChainTagController::class, 'byCategory']);
        
        // Create a new tag
        Route::post('/', [SupplyChainTagController::class, 'store'])
            ->middleware('validate.supply.chain.tag');
        
        // Update a tag
        Route::put('/{id}', [SupplyChainTagController::class, 'update'])
            ->middleware('validate.supply.chain.tag');
        
        // Verify a tag
        Route::post('/{id}/verify', [SupplyChainTagController::class, 'verify'])
            ->middleware(['validate.supply.chain.tag', 'can:verify_supply_chain_tags']);
        
        // Delete a tag
        Route::delete('/{id}', [SupplyChainTagController::class, 'destroy'])
            ->middleware(['validate.supply.chain.tag', 'can:delete_supply_chain_tags']);
    });
});