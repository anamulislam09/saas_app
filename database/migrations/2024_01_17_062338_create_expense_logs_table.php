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
        Schema::create('expense_logs', function (Blueprint $table) {
            $table->id();
            $table->string('month')->nullable();
            $table->integer('year')->nullable();
            $table->integer('cat_id');
            $table->integer('exp_id');
            $table->integer('amount');
            $table->string('auth_id');
            $table->string('updated_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_logs');
    }
};
