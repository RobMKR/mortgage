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
            'loan_input' => json_encode($loanDto->toArray()),
        ]);
    }
}
