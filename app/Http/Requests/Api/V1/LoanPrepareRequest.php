<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\BaseFormRequest;

class LoanPrepareRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|between:1000,100000',
            'interest_rate' => 'required|numeric|between:0.01,99.99',
            'duration' => 'required|numeric|between:1,50',
            'extra_monthly_payment' => 'numeric|min: 0.01',
        ];
    }
}
