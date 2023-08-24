<?php

namespace App\Repositories;

use App\Models\Loan;
use App\Models\LoanAmortizationSchedule;
use App\Services\Loan\LoanAmortizationScheduleObject;
use Illuminate\Support\Facades\DB;

class LoanAmortizationScheduleRepository
{
    public function __construct()
    {
    }

    public function create(Loan $loan, LoanAmortizationScheduleObject $loanAmortizationScheduleObject) {
        $insert = [];

        foreach ($loanAmortizationScheduleObject->toArray() as $object) {
            $insert[] = [
                'loan_id' => $loan->id,
                'month_number' => $object->getMonthNumber(),
                'starting_balance' => $object->getStartingBalance(),
                'monthly_payment' => $object->getMonthlyPayment(),
                'monthly_principal_amount' => $object->getMonthlyPrincipalAmount(),
                'monthly_interest_amount' => $object->getMonthlyInterestAmount(),
                'ending_balance' => $object->getEndingBalance(),
            ];
        }

        DB::table('loan_amortization_schedule')->insert($insert);
    }
}
