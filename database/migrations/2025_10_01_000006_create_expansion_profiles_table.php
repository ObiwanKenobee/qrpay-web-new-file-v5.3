<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpansionProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('expansion_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type'); // personal, business, enterprise, company, developer
            $table->json('settings')->nullable();
            $table->json('features')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('expansion_profiles');
    }
}