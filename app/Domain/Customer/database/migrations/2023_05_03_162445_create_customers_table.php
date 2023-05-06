<?php

use App\Domain\Customer\Models\Customer;
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
        Schema::create(Customer::TABLE_NAME, function (Blueprint $table) {
            $table->uuid()->unique()->index()->primary();
            $table->string(Customer::COL_EMAIL)->unique();
            $table->string(Customer::COL_FIRST_NAME);
            $table->string(Customer::COL_LAST_NAME);
            $table->date(Customer::COL_DATE_OF_BIRTH);
            $table->string(Customer::COL_PHONE_NUMBER);
            $table->string(Customer::COL_BACK_ACCOUNT_NUMBER);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Customer::TABLE_NAME);
    }
};
