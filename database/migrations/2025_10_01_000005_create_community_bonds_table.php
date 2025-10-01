<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityBondsTable extends Migration
{
    public function up()
    {
        Schema::create('community_bonds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('value', 18, 8);
            $table->string('currency');
            $table->string('status');
            $table->json('conditions')->nullable();
            $table->timestamp('maturity_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('community_bonds');
    }
}