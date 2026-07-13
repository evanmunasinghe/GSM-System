<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('id')->primary(); // Used as the unique slug (e.g., 'gamage-auto')
            $table->string('com_name');
            $table->string('address')->nullable();
            $table->string('tel')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->string('tag')->nullable();
            $table->string('admin')->nullable();
            $table->string('contact')->nullable();
            $table->string('ant')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
}
