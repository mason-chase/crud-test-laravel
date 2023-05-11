<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->date('date_of_birth');
            $table->string('last_name', 50);
            $table->string('email', 120)->unique();
            $table->string('phone_number', 15)->unique();
            $table->string('bank_account_number', 36);
            $table->timestamps();

            $table->unique(['first_name', 'last_name', 'date_of_birth'], 'PrimaryCustomer');
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
