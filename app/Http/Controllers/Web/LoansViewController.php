<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Repositories\LoanRepository;
use App\Services\Loan\LoanCalculator;

class LoansViewController extends Controller
{
    public function __invoke($id, LoanRepository $loanRepository, LoanCalculator $loanCalculator)
    {
        // TODO: Of course need to be limited.
        // As it is just for a testing purposes
        // We will load all available loans
        // In prod must be paginated properly!
        $loan = $loanRepository->find($id);
        $loanEffectiveRate = $loanCalculator->aer($loan->interest_rate / 100, $loan->period * 12) * 100;

        if (!$loan) {
            return back();
        }

        return view('loan', [
            'loan' => $loan,
            'loanEffectiveRate' => round($loanEffectiveRate, 2)
        ]);
    }
}
