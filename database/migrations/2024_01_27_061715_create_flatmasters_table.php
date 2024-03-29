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
        Schema::create('flatmasters', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('flat_name');
            $table->tinyInteger('sequence')->nullable();
            $table->tinyInteger('floor_no')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flatmasters');
    }
};
