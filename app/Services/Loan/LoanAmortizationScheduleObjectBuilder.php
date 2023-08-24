<?php

namespace App\Services\Loan;

class LoanAmortizationScheduleObjectBuilder
{

    protected LoanCalculationObject $loanCalculationObject;

    public function __construct(protected  LoanCalculator $loanCalculator)
    {
    }

    public function setLoanCalculationObject(LoanCalculationObject $loanCalculationObject): static
    {
        $this->loanCalculationObject = $loanCalculationObject;

        return $this;
    }

    public function build(bool $includeExtraPayments): LoanAmortizationScheduleObject
    {
        $paymentsByMonth = [];

        $balance = $this->loanCalculationObject->getTotalAmount();

        $periods = $this->loanCalculationObject->getTotalNumberOfMonths();

        for ($period = 1; $period <= $periods; $period++) {
            $lastPayment = false;

            $monthlyInterestAmount = -1 * $this->loanCalculator->ipmt($this->loanCalculationObject->getMonthlyInterestRate(), $period, $periods, $this->loanCalculationObject->getTotalAmount());
            $monthlyPrincipalAmount = -1 * $this->loanCalculator->ppmt($this->loanCalculationObject->getMonthlyInterestRate(), $period, $periods, $this->loanCalculationObject->getTotalAmount());
            $monthlyPayment = $this->loanCalculationObject->getMonthlyPayment();
            $fixedPayment = $this->loanCalculationObject->getMonthlyFixedExtraPayment();

            $startingBalance = $balance;
            $balance -= $monthlyPrincipalAmount;

            if ($includeExtraPayments) {

                if ($this->loanCalculationObject->getMonthlyFixedExtraPayment() !== null) {
                    $balance -= $this->loanCalculationObject->getMonthlyFixedExtraPayment();
                }

                if ($balance < 0) {
                    // Case with extra payments
                    // Monthly = remaining balance
                    $monthlyPayment = $startingBalance;
                    $monthlyPrincipalAmount = $monthlyPayment - $monthlyInterestAmount;
                    $fixedPayment = 0;
                    $balance = 0;

                    $lastPayment = true;
                }
            }

            $paymentsByMonth[] = new LoanMonthlyPaymentDto(
                $period,
                $startingBalance,
                $monthlyPayment,
                $monthlyPrincipalAmount,
                $monthlyInterestAmount,
                $balance,
                $fixedPayment
            );

            if ($lastPayment) {
                break;
            }
        }

        return new LoanAmortizationScheduleObject($paymentsByMonth);
    }


}
