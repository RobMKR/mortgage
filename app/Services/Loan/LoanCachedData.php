<?php

namespace App\Services\Loan;

class LoanCachedData
{
    public function __construct(protected LoanCalculationObject $loanCalculationObject, protected LoanAmortizationScheduleObject $loanAmortizationSchedule, protected LoanDto $loanDto)
    {

    }

    public function getLoanCalculationObject(): LoanCalculationObject
    {
        return $this->loanCalculationObject;
    }

    public function getLoanAmortizationSchedule(): LoanAmortizationScheduleObject
    {
        return $this->loanAmortizationSchedule;
    }

    public function getLoanDto(): LoanDto
    {
        return $this->loanDto;
    }

}
