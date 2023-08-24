<?php

namespace App\Repositories;

use App\Models\Loan;
use App\Services\Loan\LoanDto;
use Illuminate\Support\Facades\DB;

class LoanRepository
{
    public function __construct()
    {
    }

    public function create(string $loanToken, LoanDto $loanDto) {
        return Loan::create([
            'loan_token' => $loanToken,
            'amount' => $loanDto->getAmount(),
            'period' => $loanDto->getDuration(),
            'interest_rate' => $loanDto->getInterestRate(),
            'extra_payment_per_month' => $loanDto->getMonthlyFixedExtraPayment(),
        ]);
    }

    public function find($id)
    {
        return Loan::find($id);
    }
}
