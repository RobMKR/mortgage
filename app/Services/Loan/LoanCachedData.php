<?php

namespace App\Services\Loan;

class LoanCachedData
{
    public function __construct(protected LoanCalculationObject $loanCalculationObject, protected LoanDto $loanDto)
    {

    }

    public function getLoanCalculationObject(): LoanCalculationObject
    {
        return $this->loanCalculationObject;
    }

    public function getLoanDto(): LoanDto
    {
        return $this->loanDto;
    }

}
