<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserPostAndPutRequest extends FormRequest
{
    use ConvertResponseToJson;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string'
            ],
            'email' => [
                'required', 'email',
                Rule::unique('users')->ignore($this->get('uuid'), 'uuid'),
            ],
            'password' => [
                'sometimes',
                Rule::requiredIf(function () {
                    return $this->method == 'post';
                }),
            ],
        ];
    }
}
