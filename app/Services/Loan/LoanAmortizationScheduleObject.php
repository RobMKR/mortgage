<?php

namespace App\Services\Loan;

use Illuminate\Contracts\Support\Arrayable;

class LoanAmortizationScheduleObject implements Arrayable, \Countable
{

    /**
     * @param LoanMonthlyPaymentDto[] $paymentsByMonth
     */
    public function __construct(protected array $paymentsByMonth)
    {
    }

    public function toArray(): array
    {
        return $this->paymentsByMonth;
    }

    public function count(): int
    {
        return count($this->paymentsByMonth);
    }
}
