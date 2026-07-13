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
       Schema::table('vehicles', function (Blueprint $table) {
            $table->foreign('owner_id')->references('id')->on('owner_current')->onDelete('set null');
        });
        Schema::table('owner_current', function (Blueprint $table) {
            $table->foreign('vid')->references('id')->on('vehicles')->onDelete('cascade');
        });
        Schema::table('owners_past', function (Blueprint $table) {
            $table->foreign('vid')->references('id')->on('vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_foreign_keys_to_vehicle_system');
    }
};
