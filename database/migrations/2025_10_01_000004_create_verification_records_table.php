<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificationRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('verification_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
            $table->string('verifier_type'); // blockchain, community, authority
            $table->string('verification_status');
            $table->json('verification_data');
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('verification_records');
    }
}