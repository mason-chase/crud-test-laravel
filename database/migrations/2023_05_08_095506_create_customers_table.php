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
			$table->string('firstName');
			$table->string('lastName');
			$table->dateTime('dateOfBirth');
			$table->bigInteger('phoneNumber'); // will save ~3 bytes
			$table->string('email')->unique();
			$table->string('bankAccountNumber');
			$table->unique(['firstName','lastName','dateOfBirth']);
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
