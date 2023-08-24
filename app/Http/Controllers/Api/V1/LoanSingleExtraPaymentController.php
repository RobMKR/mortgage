<?php

namespace App\Http\Controllers\Api\V1;

use App\Facades\Api\V1\ILoanAmortizationScheduleGeneratorFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\SingleExtraPaymentRequest;
use App\Models\Loan;
use App\Repositories\LoanRepository;
use App\Services\Loan\Adapters\DbModelToLoanCalculationObjectAdapter;
use App\Services\Response\ResponseService;

class LoanSingleExtraPaymentController extends Controller
{
    public function __invoke($id, SingleExtraPaymentRequest $request, LoanRepository $loanRepository, DbModelToLoanCalculationObjectAdapter $dbModelToLoanCalculationObjectAdapter, ILoanAmortizationScheduleGeneratorFacade $loanAmortizationScheduleGeneratorFacade)
    {
        /** @var Loan $loan */
        $loan = $loanRepository->find($id);

        if (!$loan) {
            return ResponseService::errorMessage('Not found', 404);
        }

        $loanAmortizationScheduleObject = $dbModelToLoanCalculationObjectAdapter->adopt($loan);

        $loanAmortizationScheduleGeneratorFacade->payPartial($loanAmortizationScheduleObject, $request->get('amount'));
        // TODO: Recalculate
        // TODO: Store extra schedule in db
        // TODO: return response;

        return ResponseService::errorMessage('Not implemented', 400);
    }
}
