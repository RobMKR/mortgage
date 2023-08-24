<?php

namespace Tests\Api\V1;

use Tests\TestCase;

class  LoanPrepareTest extends TestCase
{
    /**
     * Test case when no input is specified on login call
     */
    protected const URL = 'api/v1/loan/prepare';
    protected const METHOD = 'POST';
    protected const HEADERS = ['Accept' => 'application/json'];

    /**
     * Test case when no input is specified on login call
     */
    public function testRequiredFields()
    {
        $this->json(self::METHOD, self::URL, self::HEADERS)
            ->assertStatus(422)
            ->assertJson([
                "type" => "ERR_INVALID",
                "errors" => [
                    "amount" => [],
                    "interest_rate" => [],
                    "duration" => [],
                ]
            ]);
    }

    /**
     * Test for wrong amount
     */
    public function testAmountWrong()
    {
        $userDataWithWrongAmount = [
            "amount" => "1000000000",
            "interest_rate" => "11.15",
            "duration" => "5",
        ];

        $this->json(self::METHOD, self::URL, $userDataWithWrongAmount, self::HEADERS)
            ->assertStatus(422)
            ->assertJson([
                "type" => "ERR_INVALID",
                "errors" => [
                    "amount" => ["The amount field must be between 1000 and 100000."],
                ]
            ]);
    }

    /**
     * Test for wrong amount
     */
    public function testInterestRateWrong()
    {
        $userDataWithWrongAmount = [
            "amount" => "10000",
            "interest_rate" => "101",
            "duration" => "5",
        ];

        $this->json(self::METHOD, self::URL, $userDataWithWrongAmount, self::HEADERS)
            ->assertStatus(422)
            ->assertJson([
                "type" => "ERR_INVALID",
                "errors" => [
                    "interest_rate" => ["The interest rate field must be between 0.01 and 99.99."],
                ]
            ]);
    }

    // Same test could be implemented for duration
}
