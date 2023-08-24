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
        Schema::create('loan_amortization_extra_repayment_schedule', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_id')->index();
            $table->smallInteger('month_number');
            $table->float('starting_balance');
            $table->float('monthly_payment');
            $table->float('monthly_principal_amount');
            $table->float('monthly_interest_amount');
            $table->float('extra_repayment_made');
            $table->float('ending_balance');
            $table->float('remaining_loan_term');

            $table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_amortization_extra_repayment_schedule');
    }
};
