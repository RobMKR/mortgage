<?php

namespace App\Services\Loan;

class LoanMonthlyPaymentDto implements \JsonSerializable
{
    public function __construct(
        protected int   $monthNumber,
        protected float $startingBalance,
        protected float $monthlyPayment,
        protected float $monthlyPrincipalAmount,
        protected float $monthlyInterestAmount,
        protected float $endingBalance,
        protected ?float $monthlyFixedExtraPayment = null,
    )
    {
    }

    public function getMonthNumber(): int
    {
        return $this->monthNumber;
    }

    public function getStartingBalance(): float
    {
        return $this->startingBalance;
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

    public function getMonthlyFixedExtraPayment(): ?float
    {
        return $this->monthlyFixedExtraPayment;
    }

    public function getEndingBalance(): float
    {
        return $this->endingBalance;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'monthNumber' => $this->getMonthNumber(),
            'startingBalance' => $this->getStartingBalance(),
            'monthlyPayment' => $this->getMonthlyPayment(),
            'monthlyPrincipalAmount' => $this->getMonthlyPrincipalAmount(),
            'monthlyInterestAmount' => $this->getMonthlyInterestAmount(),
            'monthlyFixedExtraPayment' => $this->getMonthlyFixedExtraPayment(),
            'endingBalance' => $this->getEndingBalance(),
        ];
    }
}
