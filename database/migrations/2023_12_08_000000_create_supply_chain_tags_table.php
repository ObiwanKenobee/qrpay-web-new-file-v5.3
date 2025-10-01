<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('supply_chain_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('supply_chain_tags')->onDelete('cascade');
            $table->string('name');
            $table->text('value');
            $table->string('category')->nullable();
            $table->string('verification_level')->default('pending');
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->timestamp('verification_date')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['transaction_id', 'category']);
            $table->index(['verification_level', 'verification_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('supply_chain_tags');
    }
};