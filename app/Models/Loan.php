<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'loan_token',
        'loan_input',
    ];

    public function loanAmortizationScheduleRows() {
        return $this->hasMany(LoanAmortizationSchedule::class);
    }
}
