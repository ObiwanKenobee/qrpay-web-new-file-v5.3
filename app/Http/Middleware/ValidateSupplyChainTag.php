<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Transaction;

class ValidateSupplyChainTag
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->has('transaction_id')) {
            return response()->json(['error' => 'Transaction ID is required'], 400);
        }

        $transaction = Transaction::find($request->transaction_id);
        if (!$transaction) {
            return response()->json(['error' => 'Transaction not found'], 404);
        }

        // Check if user has permission to add tags to this transaction
        if (!$this->canManageTags($request->user(), $transaction)) {
            return response()->json(['error' => 'Unauthorized to manage supply chain tags'], 403);
        }

        return $next($request);
    }

    private function canManageTags($user, $transaction)
    {
        // User must be either the transaction creator, merchant, or have special permissions
        return $user->id === $transaction->user_id ||
               $user->id === $transaction->merchant_id ||
               $user->hasPermissionTo('manage_supply_chain_tags');
    }
}