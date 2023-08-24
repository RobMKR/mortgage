<?php

namespace App\Http\Requests;

use App\Services\Response\ResponseService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

abstract class BaseFormRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $_errors = [];


        foreach ($validator->errors()->toArray() as $fieldName => $messages){
            $_errors[$fieldName] = $messages;
        }

        if($this->wantsJson()) {
            $response = ResponseService::invalid($_errors);
        } else {
            $response = redirect()
                ->route('guest.login')
                ->with('message', 'Ops! Some errors occurred')
                ->withErrors($validator);
        }

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
