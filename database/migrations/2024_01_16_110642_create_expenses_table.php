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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->nullable();
            $table->string('month')->nullable();
            $table->integer('cat_id');
            $table->double('sub_total', 20, 2)->default(0);
            $table->double('total', 20, 2)->default(0);
            $table->integer('customer_id');
            $table->string('auth_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
