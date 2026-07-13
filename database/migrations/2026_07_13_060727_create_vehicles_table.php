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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id');
            $table->string('plate')->unique();
            $table->string('engine_no')->nullable();
            $table->string('chassis_no')->nullable();
            $table->unsignedBigInteger('owner_id')->nullable(); // Foreign ID reference to target active owner
            $table->string('ant')->nullable();
            $table->string('vehicletype')->nullable();
            $table->string('make');
            $table->string('model');
            $table->string('man_year')->nullable();
            $table->string('reg_year')->nullable();
            $table->string('colour')->nullable();
            $table->string('country')->nullable();
            $table->string('bookcopy')->nullable(); // Stores filepath
            $table->string('odo')->nullable();
            $table->date('next_rev')->nullable();
            $table->date('next_ins')->nullable();
            $table->string('ins_com')->nullable();
            $table->date('next_emmission')->nullable();
            $table->string('m_value')->nullable(); // Financial valuation metric
            $table->date('regdate')->nullable();
            $table->timestamps();

            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
            $table->index(['tenant_id', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
