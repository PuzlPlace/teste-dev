<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;

trait ConvertResponseToJson
{
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'validation_errors' => $validator->errors()->all(),
            'success' => false
        ], 422));
    }
}
