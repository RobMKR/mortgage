<?php

namespace App\Services\Loan\Adapters;

use App\Models\Loan;
use App\Services\Loan\LoanAmortizationScheduleObject;
use App\Services\Loan\LoanMonthlyPaymentDto;
use Illuminate\Support\Collection;

class DbModelToLoanCalculationObjectAdapter
{
    public function adopt(Loan $loan): LoanAmortizationScheduleObject {
        /** @var Collection $scheduleRows */
        $scheduleRows = $loan->loanAmortizationScheduleRows;

        $paymentsByMonth = [];

        foreach ($scheduleRows->sortBy('month_number') as $row) {
            $paymentsByMonth[] = new LoanMonthlyPaymentDto(
                $row['month_number'],
                $row['starting_balance'],
                $row['monthly_payment'],
                $row['monthly_principal_amount'],
                $row['monthly_interest_amount'],
                $row['ending_balance'],
                $row['monthly_fixed_extra_payment']
            );
        }

        return new LoanAmortizationScheduleObject($paymentsByMonth);
    }
}
