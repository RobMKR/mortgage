<?php

namespace App\Facades\Api\V1;

use App\Services\Loan\LoanAmortizationScheduleObject;
use App\Services\Loan\LoanAmortizationScheduleObjectBuilder;
use App\Services\Loan\LoanCalculationObject;

class LoanAmortizationScheduleGeneratorFacade implements ILoanAmortizationScheduleGeneratorFacade
{

    public function __construct(protected LoanAmortizationScheduleObjectBuilder $loanAmortizationScheduleObjectBuilder)
    {
    }

    public function generate(LoanCalculationObject $loanCalculationObject): LoanAmortizationScheduleObject
    {
        return $this->loanAmortizationScheduleObjectBuilder->setLoanCalculationObject($loanCalculationObject)->build();
    }
}
