<?php

namespace App\Facades\Api\V1;

use App\Services\Loan\LoanAmortizationScheduleObject;
use App\Services\Loan\LoanAmortizationScheduleObjectBuilder;
use App\Services\Loan\LoanAmortizationScheduleObjectSinglePaymentProcessor;
use App\Services\Loan\LoanCalculationObject;

class LoanAmortizationScheduleGeneratorFacade implements ILoanAmortizationScheduleGeneratorFacade
{

    public function __construct(protected LoanAmortizationScheduleObjectBuilder $loanAmortizationScheduleObjectBuilder, protected LoanAmortizationScheduleObjectSinglePaymentProcessor $loanAmortizationScheduleObjectSinglePaymentProcessor)
    {
    }

    public function generate(LoanCalculationObject $loanCalculationObject, bool $includeExtraPayments): LoanAmortizationScheduleObject
    {
        return $this->loanAmortizationScheduleObjectBuilder->setLoanCalculationObject($loanCalculationObject)->build($includeExtraPayments);
    }

    public function payPartial(LoanAmortizationScheduleObject $loanAmortizationScheduleObject, float $singlePayment): LoanAmortizationScheduleObject
    {
        return $this->loanAmortizationScheduleObjectSinglePaymentProcessor->regenerateWithSinglePayment($loanAmortizationScheduleObject, $singlePayment);
    }
}
