<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('domain_details', function (Blueprint $table) {
            $table->id();
            $table->integer('domain_id');
            $table->string('qid');
            $table->string('risk')->nullable();
            $table->string('risk_recommended')->nullable();
            $table->string('manualrisk')->nullable();
            $table->string('retired')->nullable();
            $table->string('stamp_added')->nullable();
            $table->string('stamp_updated')->nullable();
            $table->string('stamp_seen')->nullable();
            $table->string('stamp_probed')->nullable();
            $table->string('stamp_retired')->nullable();
            $table->string('recent')->nullable();
            $table->string('submissions')->nullable();
            $table->string('umbrella_rank')->nullable();
            $table->string('umbrella_domain')->nullable();
            $table->longText('riskfactors');
            $table->longText('redirects');
            $table->longText('attributes');
            $table->longText('properties');
            $table->longText('links');
            $table->enum('report', [true, false])->default('');
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domain_details');
    }
};
