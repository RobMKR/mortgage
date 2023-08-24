<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'loan_token',
        'amount',
        'period',
        'interest_rate',
        'extra_payment_per_month',
    ];

    public function loanAmortizationScheduleRows() {
        return $this->hasMany(LoanAmortizationSchedule::class);
    }

    public function loanAmortizationExtraRepaymentScheduleRows() {
        return $this->hasMany(LoanAmortizationExtraRepaymentSchedule::class);
    }
}
