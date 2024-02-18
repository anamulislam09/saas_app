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
        Schema::create('opening_balances', function (Blueprint $table) {
            $table->id();
            $table->string('month')->nullable();
            $table->integer('year')->nullable();
            $table->integer('customer_id');
            $table->integer('auth_id');
            $table->date('entry_datetime');
            $table->bigInteger('profit')->nullable();
            $table->bigInteger('loss')->nullable();
            $table->integer('flag');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opening_balances');
    }
};
