<?php

namespace App\Facades\Api\V1;

use App\Services\Loan\LoanAmortizationScheduleObject;
use App\Services\Loan\LoanCalculationObject;

interface ILoanAmortizationScheduleGeneratorFacade
{
    public function generate(LoanCalculationObject $loanCalculationObject, bool $includeExtraPayments): LoanAmortizationScheduleObject;

    public function payPartial(LoanAmortizationScheduleObject $loanAmortizationScheduleObject, float $singlePayment): LoanAmortizationScheduleObject;
}
