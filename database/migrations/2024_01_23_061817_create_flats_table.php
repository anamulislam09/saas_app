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
        Schema::create('flats', function (Blueprint $table) {
            $table->id();
            $table->string('flat_unique_id')->nullable();
            $table->integer('customer_id');
            $table->string('flat_name');
            $table->tinyInteger('sequence')->nullable();
            $table->tinyInteger('floor_no')->nullable();
            $table->string('charge')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('create_date')->nullable();
            $table->string('create_month')->nullable();
            $table->integer('create_year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flats');
    }
};
