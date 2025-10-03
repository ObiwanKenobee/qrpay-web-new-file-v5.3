Route::apiResource('wallets', WalletController::class);
Route::apiResource('assets', AssetController::class);
Route::apiResource('transactions', TransactionController::class);

Route::post('consensus/propose', [ConsensusController::class, 'propose']);
Route::post('bridge/webhook', [BridgeController::class, 'handle']);
Route::post('governance/proposals', [GovernanceController::class, 'create']);
