<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest as DefaultRequest;

class FormRequest extends DefaultRequest
{ 
    /**
    * Handle a failed validation attempt.
    *
    * @param  \Illuminate\Contracts\Validation\Validator $validator
    * @return void
    *
    * @throws \Illuminate\Validation\ValidationException
    */

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->render([
            'status' => 'invalidate_request',
            'message' => $validator->errors()->first(),
            'errors' => $validator->errors(),
        ]));
    } 
}
