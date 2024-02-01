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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unique()->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('flat_id')->nullable();
            $table->string('charge')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('nid_no')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('status')->default(0);
            $table->integer('role_id')->default(0);
            $table->rememberToken();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
