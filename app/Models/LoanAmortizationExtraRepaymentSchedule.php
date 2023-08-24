<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanAmortizationExtraRepaymentSchedule extends Model
{
    public $timestamps = false;

    protected $table = 'loan_amortization_extra_repayment_schedule';

    protected $fillable = [
        'loan_id',
        'month_number',
        'starting_balance',
        'monthly_payment',
        'monthly_principal_amount',
        'monthly_interest_amount',
        'extra_repayment_made',
        'ending_balance',
        'remaining_loan_term',
    ];
}
