<?php

namespace App\Services\Loan;

use Carbon\Carbon;

class LoanAmortizationScheduleObjectBuilder
{
    protected LoanCalculationObject $loanCalculationObject;

    public function setLoanCalculationObject(LoanCalculationObject $loanCalculationObject): static
    {
        $this->loanCalculationObject = $loanCalculationObject;

        return $this;
    }

    public function build(): LoanAmortizationScheduleObject
    {
        $paymentsByMonth = [];

        // Not too accurate, but let's assume that every payment date is first day of the month starting from the next month
        $currentPaymentDate = Carbon::now()->addMonth()->startOfMonth();
        $balance = $this->loanCalculationObject->getMonthlyPayment() * $this->loanCalculationObject->getTotalNumberOfMonths();

        for ($i = 0; $i < $this->loanCalculationObject->getTotalNumberOfMonths(); $i++) {
            $startingBalance = $balance;
            $balance = $balance - $this->loanCalculationObject->getMonthlyPayment();

            $paymentsByMonth[] = new LoanMonthlyPaymentDto(
                $currentPaymentDate->toDateString(),
                $i + 1,
                $startingBalance,
                $this->loanCalculationObject->getMonthlyPayment(),
                $this->loanCalculationObject->getMonthlyPrincipalAmount(),
                $this->loanCalculationObject->getMonthlyInterestAmount(),
                $balance
            );

            $currentPaymentDate->addMonth();
        }

        return new LoanAmortizationScheduleObject($paymentsByMonth);
    }
}
