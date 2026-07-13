<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Link Vehicle to its Current Owner
        Schema::table('vehicles', function (Blueprint $table) {
            $table->foreign('owner_id')->references('id')->on('owner_current')->onDelete('set null');
        });

        // 2. Link Current Owner back to the Vehicle
        Schema::table('owner_current', function (Blueprint $table) {
            $table->foreign('vid')->references('id')->on('vehicles')->onDelete('cascade');
        });

        // 3. Link Past Owners log back to the Vehicle
        Schema::table('owners_past', function (Blueprint $table) {
            $table->foreign('vid')->references('id')->on('vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
        });

        Schema::table('owner_current', function (Blueprint $table) {
            $table->dropForeign(['vid']);
        });

        Schema::table('owners_past', function (Blueprint $table) {
            $table->dropForeign(['vid']);
        });
    }
};