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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->unsignedBigInteger('phone_number');
            $table->string('email')->unique();
            $table->unsignedBigInteger('bank_account_number');

            $table->unique(['first_name', 'last_name', 'date_of_birth']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
