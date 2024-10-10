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
        Schema::create('tax_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Reference to users table
            $table->string('name');
            $table->string('ssn');
            $table->string('address');
            $table->decimal('w2_income', 15, 2)->nullable();
            $table->decimal('self_employment_income', 15, 2)->nullable();
            $table->decimal('mortgage_interest', 15, 2)->nullable();
            $table->decimal('charitable_donations', 15, 2)->nullable();
            $table->decimal('child_tax_credit', 15, 2)->nullable();
            $table->decimal('education_credit', 15, 2)->nullable();
            $table->decimal('federal_tax_withheld', 15, 2)->nullable();
            $table->decimal('state_tax_withheld', 15, 2)->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_information');
    }
};
