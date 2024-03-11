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
        Schema::create('monthly_blances', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->string('auth_id')->nullable();
            $table->integer('year');
            $table->string('month');
            $table->bigInteger('total_income');
            $table->bigInteger('total_expense');
            $table->bigInteger('amount');
            $table->tinyInteger('flag');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_blances');
    }
};
