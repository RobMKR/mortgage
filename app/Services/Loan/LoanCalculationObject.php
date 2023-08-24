<?php

namespace App\Services\Loan;

use App\Services\IHashable;
use Illuminate\Contracts\Support\Arrayable;

class LoanCalculationObject implements Arrayable, IHashable
{
    public function __construct(protected float $monthlyInterestRate, protected int $totalNumberOfMonths, protected float $monthlyPayment, protected float $monthlyPrincipalAmount, protected float $monthlyInterestAmount)
    {

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

    public function getMonthlyPrincipalAmount(): float
    {
        return $this->monthlyPrincipalAmount;
    }

    public function getMonthlyInterestAmount(): float
    {
        return $this->monthlyInterestAmount;
    }

    public function toArray(): array
    {
        return [
            'monthlyInterestRate' => $this->monthlyInterestRate,
            'totalNumberOfMonths' => $this->totalNumberOfMonths,
            'monthlyPayment' => $this->monthlyPayment,
            'monthlyPrincipalAmount' => $this->monthlyPrincipalAmount,
            'monthlyInterestAmount' => $this->monthlyInterestAmount,
        ];
    }

    public function hash(): string
    {
        return md5(microtime(true) . json_encode($this->toArray()));
    }
}
