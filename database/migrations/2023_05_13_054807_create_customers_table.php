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
            $table->uuid()->index()->unique();
            $table->string('email')->index()->unique();
            $table->string('phone_number', 20)->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('date_of_brith')->nullable();
            $table->string('bank_account_number')->nullable();

            $table->unique(['first_name', 'last_name', 'date_of_brith']);

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
