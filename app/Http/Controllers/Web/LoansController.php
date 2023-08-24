<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Loan;

class LoansController extends Controller
{
    public function __invoke()
    {
        // TODO: Of course need to be limited.
        // As it is just for a testing purposes
        // We will load all available loans
        // In prod must be paginated properly!
        $loans = Loan::all();

        return view('loans', [
            'loans' => $loans
        ]);
    }
}
