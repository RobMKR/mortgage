<?php

namespace App\Http\Controllers\Api\V1;

use App\Facades\Api\V1\ILoanAmortizationScheduleGeneratorFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoanApproveRequest;
use App\Repositories\LoanAmortizationExtraRepaymentScheduleRepository;
use App\Repositories\LoanAmortizationScheduleRepository;
use App\Repositories\LoanRepository;
use App\Services\Loan\LoanCachedData;
use App\Services\Response\ResponseService;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class LoanApproveController extends Controller
{
    public function __invoke(LoanApproveRequest $request, LoanRepository $loanRepository, LoanAmortizationScheduleRepository $loanAmortizationScheduleRepository, LoanAmortizationExtraRepaymentScheduleRepository $loanAmortizationExtraRepaymentScheduleRepository, ILoanAmortizationScheduleGeneratorFacade $loanAmortizationScheduleGeneratorFacade)
    {
        $token = $request->get('token');

        /** @var LoanCachedData|null $loanCachedData */
        $loanCachedData = Cache::get($token);

        if (!$loanCachedData) {
            return ResponseService::errorMessage('Loan with provided token doesnt exist', 404);
        }
        try {
            // Generate without extra payments
            $loanAmortizationScheduleObjectWithoutFixedPayment = $loanAmortizationScheduleGeneratorFacade->generate($loanCachedData->getLoanCalculationObject(), false);

            $loanAmortizationScheduleObjectWithFixedPayment = null;

            if ($loanCachedData->getLoanDto()->getMonthlyFixedExtraPayment() !== null) {
                // Generate with extra payments
                $loanAmortizationScheduleObjectWithFixedPayment = $loanAmortizationScheduleGeneratorFacade->generate($loanCachedData->getLoanCalculationObject(), true);
            }

            DB::transaction(function () use (
                $token,
                $loanCachedData,
                $loanRepository,
                $loanAmortizationScheduleRepository,
                $loanAmortizationExtraRepaymentScheduleRepository,
                $loanAmortizationScheduleObjectWithoutFixedPayment,
                $loanAmortizationScheduleObjectWithFixedPayment
            ) {
                $loan = $loanRepository->create($token, $loanCachedData->getLoanDto());
                $loanAmortizationScheduleRepository->create($loan, $loanAmortizationScheduleObjectWithoutFixedPayment);

                if ($loanAmortizationScheduleObjectWithFixedPayment) {
                    $loanAmortizationExtraRepaymentScheduleRepository->create($loan, $loanAmortizationScheduleObjectWithFixedPayment);
                }
            });

            Cache::forget($token);

            return ResponseService::successMessage('Loan Stored');
        } catch (UniqueConstraintViolationException $e) {
            return ResponseService::errorMessage('Loan with provided token already stored in DB', 400);
        }
    }
}
