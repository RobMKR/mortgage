<?php

namespace App\Facades\Api\V1;

use App\Services\Loan\LoanCalculationObject;
use App\Services\Loan\LoanDto;

interface ILoanPreparationFacade
{
    public function prepareLoanObject(LoanDto $loanDto): LoanCalculationObject;
}
