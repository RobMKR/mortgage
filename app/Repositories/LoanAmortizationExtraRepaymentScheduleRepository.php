<?php

namespace App\Repositories;

use App\Models\Loan;
use App\Services\Loan\LoanAmortizationScheduleObject;
use Illuminate\Support\Facades\DB;

class LoanAmortizationExtraRepaymentScheduleRepository
{
    public function __construct()
    {
    }

    public function create(Loan $loan, LoanAmortizationScheduleObject $loanAmortizationScheduleObject)
    {
        $insert = [];

        $totalCount = $loanAmortizationScheduleObject->count();

        foreach ($loanAmortizationScheduleObject->toArray() as $object) {
            $insert[] = [
                'loan_id' => $loan->id,
                'month_number' => $object->getMonthNumber(),
                'starting_balance' => $object->getStartingBalance(),
                'monthly_payment' => $object->getMonthlyPayment(),
                'monthly_principal_amount' => $object->getMonthlyPrincipalAmount(),
                'monthly_interest_amount' => $object->getMonthlyInterestAmount(),
                'extra_repayment_made' => $object->getMonthlyFixedExtraPayment(),
                'ending_balance' => $object->getEndingBalance(),
                'remaining_loan_term' => --$totalCount,
            ];
        }

        DB::table('loan_amortization_extra_repayment_schedule')->insert($insert);
    }
}
