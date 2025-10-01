<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEthicalImpactMetricsTable extends Migration
{
    public function up()
    {
        Schema::create('ethical_impact_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained()->onDelete('cascade');
            $table->string('metric_type'); // environmental, social, governance
            $table->decimal('value', 10, 2);
            $table->string('unit');
            $table->json('verification_data')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ethical_impact_metrics');
    }
}