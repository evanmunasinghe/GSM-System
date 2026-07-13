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
        Schema::create('owner_current', function (Blueprint $table) {
           $table->id();
            $table->string('tenant_id');
            $table->unsignedBigInteger('vid'); // Vehicle ID relationship link
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->string('identification')->nullable(); // NIC / Passport
            $table->text('narration')->nullable();
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
        Schema::dropIfExists('owner_current');
    }
};
