<?php

namespace App\Services\Loan;

use Carbon\Carbon;

/**
 * helper functions copied from math-php open source project~!
 * Could be also replaced with full package of math-php
 *
 * @see https://github.com/markrogoyski/math-php/blob/master/src/Finance.php
 */
class LoanAmortizationScheduleObjectBuilder
{
    public const EPSILON = 1e-6;

    protected LoanCalculationObject $loanCalculationObject;

    public function setLoanCalculationObject(LoanCalculationObject $loanCalculationObject): static
    {
        $this->loanCalculationObject = $loanCalculationObject;

        return $this;
    }

    public function build(): LoanAmortizationScheduleObject
    {
        $paymentsByMonth = [];

        $balance = $this->loanCalculationObject->getMonthlyPayment() * $this->loanCalculationObject->getTotalNumberOfMonths();

        $periods = $this->loanCalculationObject->getTotalNumberOfMonths();

        for ($i = 0; $i < $periods; $i++) {
            $period = $i + 1;

            $startingBalance = $balance;
            $balance = $balance - $this->loanCalculationObject->getMonthlyPayment();

            $monthlyInterestAmount = -1 * $this->ipmt($this->loanCalculationObject->getMonthlyInterestRate(), $period, $periods, $this->loanCalculationObject->getTotalAmount());
            $monthlyPrincipalAmount = -1 * $this->ppmt($this->loanCalculationObject->getMonthlyInterestRate(), $period, $periods, $this->loanCalculationObject->getTotalAmount());

            $paymentsByMonth[] = new LoanMonthlyPaymentDto(
                $period,
                $startingBalance,
                $this->loanCalculationObject->getMonthlyPayment(),
                $monthlyPrincipalAmount,
                $monthlyInterestAmount,
                $balance
            );
        }

        return new LoanAmortizationScheduleObject($paymentsByMonth);
    }

    public function ppmt(float $rate, int $period, int $periods, float $present_value, float $future_value = 0.0, bool $beginning = false): float
    {
        $payment = $this->pmt($rate, $periods, $present_value, $future_value, $beginning);
        $ipmt    = $this->ipmt($rate, $period, $periods, $present_value, $future_value, $beginning);

        return $payment - $ipmt;
    }

    public function ipmt(float $rate, int $period, int $periods, float $present_value, float $future_value = 0.0, bool $beginning = false): float
    {
        if ($period < 1 || $period > $periods) {
            return \NAN;
        }

        if ($rate == 0) {
            return 0;
        }

        if ($beginning && $period == 1) {
            return 0.0;
        }

        $payment = $this->pmt($rate, $periods, $present_value, $future_value, $beginning);
        if ($beginning) {
            $interest = ($this->fv($rate, $period - 2, $payment, $present_value, $beginning) - $payment) * $rate;
        } else {
            $interest = $this->fv($rate, $period - 1, $payment, $present_value, $beginning) * $rate;
        }

        return $this->checkZero($interest);
    }

    private function pmt(float $rate, int $periods, float $present_value, float $future_value = 0.0, bool $beginning = false): float
    {
        $when = $beginning ? 1 : 0;

        if ($rate == 0) {
            return - ($future_value + $present_value) / $periods;
        }

        return - ($future_value + ($present_value * \pow(1 + $rate, $periods)))
            /
            ((1 + $rate * $when) / $rate * (\pow(1 + $rate, $periods) - 1));
    }

    private function checkZero(float $value, float $epsilon = self::EPSILON): float
    {
        return \abs($value) < $epsilon ? 0.0 : $value;
    }

    private function fv(float $rate, int $periods, float $payment, float $present_value, bool $beginning = false): float
    {
        $when = $beginning ? 1 : 0;

        if ($rate == 0) {
            $fv = -($present_value + ($payment * $periods));
            return $this->checkZero($fv);
        }

        $initial  = 1 + ($rate * $when);
        $compound = \pow(1 + $rate, $periods);
        $fv       = - (($present_value * $compound) + (($payment * $initial * ($compound - 1)) / $rate));

        return $this->checkZero($fv);
    }
}
