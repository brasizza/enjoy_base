<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

abstract class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }



    protected function failedValidation(Validator $validator)
    {
        $response = new Response([
            "status" => 'fail',
            "code" => 422,
            "data" => [
                "errors" => $validator->errors()
            ]
        ], 422);
        throw new ValidationException($validator, $response);
    }

    abstract public function rules();
}
