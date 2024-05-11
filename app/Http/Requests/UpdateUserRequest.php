<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
class UpdateUserRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, response()->json($validator->errors(), 422));
    }
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'min:4',
            'email'=> 'email|unique:users',
            'password' => 'min:6|confirmed',
            'role' => 'in:user,admin',
            'phone_number' => [ 'string', 'regex:/^(\+)?(00)?(963)?9\d{8}$/', 'unique:users']        ];
    }
}
