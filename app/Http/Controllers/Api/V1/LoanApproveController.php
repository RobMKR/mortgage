<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoanApproveRequest;
use App\Repositories\LoanAmortizationScheduleRepository;
use App\Repositories\LoanRepository;
use App\Services\Loan\LoanCachedData;
use App\Services\Response\ResponseService;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class LoanApproveController extends Controller
{
    public function __invoke(LoanApproveRequest $request, LoanRepository $loanRepository, LoanAmortizationScheduleRepository $loanAmortizationScheduleRepository)
    {
        $token = $request->get('token');

        /** @var LoanCachedData|null $loanCachedData */
        $loanCachedData = Cache::get($token);

        if (!$loanCachedData) {
            return ResponseService::errorMessage('Loan with provided token doesnt exist', 404);
        }
        try {
            DB::transaction(function () use ($token, $loanCachedData, $loanRepository, $loanAmortizationScheduleRepository) {
                $loan = $loanRepository->create($token, $loanCachedData->getLoanDto());
                $loanAmortizationScheduleRepository->create($loan, $loanCachedData->getLoanAmortizationSchedule());
            });

            Cache::forget($token);

            return ResponseService::successMessage('Loan Stored');
        } catch (UniqueConstraintViolationException $e) {
            return ResponseService::errorMessage('Loan with provided token already stored in DB', 400);
        }
    }
}
