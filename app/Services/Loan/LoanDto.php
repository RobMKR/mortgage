<?php

namespace App\Services\Loan;

use Illuminate\Contracts\Support\Arrayable;

class LoanDto implements Arrayable
{
    public function __construct(protected int $amount, protected float $interestRate, protected int $duration, protected ?float $monthlyFixedExtraPayment)
    {

    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getInterestRate(): float
    {
        return $this->interestRate;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getMonthlyFixedExtraPayment(): ?float
    {
        return $this->monthlyFixedExtraPayment;
    }

    public function toArray(): array
    {
        return [
            'amount' => $this->getAmount(),
            'interestRate' => $this->getInterestRate(),
            'duration' => $this->getDuration(),
            'monthlyFixedExtraPayment' => $this->getMonthlyFixedExtraPayment(),
        ];
    }
}
