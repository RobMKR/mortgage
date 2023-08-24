<?php

namespace App\Services\Loan;

use App\Services\IHashable;
use Illuminate\Contracts\Support\Arrayable;

class LoanCalculationObject implements Arrayable, IHashable
{
    public function __construct(
        protected float  $totalAmount,
        protected float  $monthlyInterestRate,
        protected int    $totalNumberOfMonths,
        protected float  $monthlyPayment,
        protected ?float $monthlyFixedExtraPayment
    )
    {

    }

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    public function getMonthlyInterestRate(): float
    {
        return $this->monthlyInterestRate;
    }

    public function getTotalNumberOfMonths(): int
    {
        return $this->totalNumberOfMonths;
    }

    public function getMonthlyPayment(): float
    {
        return $this->monthlyPayment;
    }

    public function getMonthlyFixedExtraPayment(): ?float
    {
        return $this->monthlyFixedExtraPayment;
    }

    public function toArray(): array
    {
        return [
            'totalAmount' => $this->totalAmount,
            'monthlyInterestRate' => $this->monthlyInterestRate,
            'totalNumberOfMonths' => $this->totalNumberOfMonths,
            'monthlyPayment' => $this->monthlyPayment,
            'monthlyFixedExtraPayment' => $this->monthlyFixedExtraPayment,
        ];
    }

    public function hash(): string
    {
        return md5(microtime(true) . json_encode($this->toArray()));
    }
}
