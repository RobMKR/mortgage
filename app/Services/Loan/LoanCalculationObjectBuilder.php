<?php

namespace App\Services\Loan;

class LoanCalculationObjectBuilder
{
    protected LoanDto $loanDto;

    public function setLoanDto(LoanDto $loanDto): static
    {
        $this->loanDto = $loanDto;

        return $this;
    }

    public function build(): LoanCalculationObject
    {
        $monthlyInterestRate = ($this->loanDto->getInterestRate() / 12) / 100;
        $totalNumberOfMonths = $this->loanDto->getDuration() * 12;

        // Monthly payment = (Loan amount * Monthly interest rate) / (1 - (1 + Monthly interest rate)^(-Number of months))
        $monthlyPayment = ($this->loanDto->getAmount() * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$totalNumberOfMonths));
        $monthlyPrincipalAmount = $this->loanDto->getAmount() / $totalNumberOfMonths;
        $monthlyInterestAmount = $monthlyPayment - $monthlyPrincipalAmount;

        return new LoanCalculationObject($monthlyInterestRate, $totalNumberOfMonths, $monthlyPayment, $monthlyPrincipalAmount, $monthlyInterestAmount);
    }
}
