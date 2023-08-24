<?php

namespace App\Providers;

use App\Facades\Api\V1\ILoanAmortizationScheduleGeneratorFacade;
use App\Facades\Api\V1\ILoanPreparationFacade;
use App\Facades\Api\V1\LoanAmortizationScheduleGeneratorFacade;
use App\Facades\Api\V1\LoanPreparationFacade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ILoanPreparationFacade::class, LoanPreparationFacade::class);
        $this->app->bind(ILoanAmortizationScheduleGeneratorFacade::class, LoanAmortizationScheduleGeneratorFacade::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
