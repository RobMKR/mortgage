<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanAmortizationSchedule extends Model
{
    public $timestamps = false;

    protected $table = 'loan_amortization_schedule';

    protected $fillable = [
        'loan_id',
        'month_number',
        'starting_balance',
        'monthly_payment',
        'monthly_principal_amount',
        'monthly_interest_amount',
        'ending_balance',
    ];
}
