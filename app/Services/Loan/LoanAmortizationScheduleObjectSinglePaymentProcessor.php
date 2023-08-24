<?php

namespace App\Services\Loan;

class LoanAmortizationScheduleObjectSinglePaymentProcessor
{
    public function regenerateWithSinglePayment(LoanAmortizationScheduleObject $loanAmortizationScheduleObject, float $amount) {
        // I'm not really sure is this needed or no. Seems no single payments allowed by the task.
        // If they are needed we can recalculate it here but probably month_number also would be needed to deduct started from that month
        // Real life example would be user paid for first year, then on 13th month he decided to pay extra and it is single time payment
        // We need to recalculate the rest of the loan
        // But as there is no logic for monthly payments right now, it doens't make sense to have it

        // TODO: Recalculate
        return $loanAmortizationScheduleObject;
    }
}
