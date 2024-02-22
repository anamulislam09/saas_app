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
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->string('month')->nullable();
            $table->integer('year')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('auth_id')->nullable();
            $table->string('flat_id')->nullable();
            $table->string('flat_name')->nullable();
            $table->string('charge')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->bigInteger('due')->nullable();
            $table->bigInteger('paid')->nullable();
            $table->bigInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
