<?php

namespace App\Http\Controllers\Api\V1;

use App\Facades\Api\V1\ILoanAmortizationScheduleGeneratorFacade;
use App\Facades\Api\V1\ILoanPreparationFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoanPrepareRequest;
use App\Services\Loan\LoanCachedData;
use App\Services\Loan\LoanDto;
use App\Services\Response\ResponseService;
use Illuminate\Support\Facades\Cache;

class LoanPrepareController extends Controller
{
    protected const FIELD_AMOUNT = 'amount';
    protected const FIELD_INTEREST_RATE = 'interest_rate';
    protected const FIELD_DURATION = 'duration';
    protected const FIELD_EXTRA_MONTHLY_PAYMENT = 'extra_monthly_payment';

    public function __invoke(LoanPrepareRequest $request, ILoanPreparationFacade $loanPreparationFacade, ILoanAmortizationScheduleGeneratorFacade $loanAmortizationScheduleGeneratorFacade)
    {
        // Validation has been done in LoanPrepareRequest
        $loanDto = new LoanDto(
            $request->get(self::FIELD_AMOUNT),
            $request->get(self::FIELD_INTEREST_RATE),
            $request->get(self::FIELD_DURATION),
            $request->get(self::FIELD_EXTRA_MONTHLY_PAYMENT),
        );

        $loanCalculationObject = $loanPreparationFacade->prepareLoanObject($loanDto);

        $cacheToken = $loanCalculationObject->hash();

        // Cache both for 1 hour
        Cache::put($cacheToken, new LoanCachedData($loanCalculationObject, $loanDto), now()->addMinutes(60));

        return ResponseService::data(collect([
            'loanToken' => $cacheToken,
            'loanData' => $loanCalculationObject->toArray(),
            'loanAmortizationSchedule' => $loanAmortizationScheduleGeneratorFacade->generate($loanCalculationObject, true)
        ]), $loanDto);
    }
}
