<?php

namespace App\Facades\Api\V1;

use App\Services\Loan\LoanCalculationObject;
use App\Services\Loan\LoanCalculationObjectBuilder;
use App\Services\Loan\LoanDto;

class LoanPreparationFacade implements ILoanPreparationFacade
{
    public function __construct(protected LoanCalculationObjectBuilder $loanCalculationObjectBuilder)
    {
    }

    public function prepareLoanObject(LoanDto $loanDto): LoanCalculationObject
    {
        return $this->loanCalculationObjectBuilder->setLoanDto($loanDto)->build();
    }
}
