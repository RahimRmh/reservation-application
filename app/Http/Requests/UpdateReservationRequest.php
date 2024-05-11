<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
class UpdateReservationRequest extends FormRequest
{
     /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
     'resturant_id' => 'integer|exists:restaurants,id',
     'user_id' => 'integer|exists:users,id',
     'notes' => 'nullable|string|max:255',
     'quantity' => 'integer|min:1',
     'start_date' => 'date|after_or_equal:today',
  
    ] ;}
}
