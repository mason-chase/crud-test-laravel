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
        Schema::create('customers', static function (Blueprint $table) {
            $table->id();
            $table->string(column: 'first_name', length: 40);
            $table->date(column: 'date_of_birth');
            $table->string(column: 'last_name', length: 40);
            $table->string(column: 'email', length: 150);
            $table->string(column: 'phone_number', length: 25);
            $table->string(column: 'bank_account_number', length: 36);
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
