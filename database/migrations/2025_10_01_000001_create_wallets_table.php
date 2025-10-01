<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('address')->unique();
            $table->decimal('balance', 18, 8)->default(0);
            $table->string('currency')->default('UVI');
            $table->boolean('is_active')->default(true);
            $table->json('offline_cache')->nullable();
            $table->timestamp('last_sync')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}