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
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('last_login')->default(now());
        });

        Schema::table('organizations', function (Blueprint $table) {
            $table->timestamp('last_search')->default(now());
            $table->enum('status', ['ACTIVE', 'LOCKED'])->default('ACTIVE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_login');
        });
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn('last_search');
            $table->dropColumn('status');
        });

    }
};
