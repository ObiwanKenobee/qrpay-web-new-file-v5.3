<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEthicalTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('ethical_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_wallet_id')->constrained('wallets')->onDelete('cascade');
            $table->foreignId('receiver_wallet_id')->constrained('wallets')->onDelete('cascade');
            $table->decimal('amount', 18, 8);
            $table->string('currency');
            $table->string('status');
            $table->string('qr_hash')->nullable();
            $table->boolean('is_offline')->default(false);
            $table->json('ethical_tags')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ethical_transactions');
    }
}