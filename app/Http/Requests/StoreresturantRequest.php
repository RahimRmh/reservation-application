<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
class StoreresturantRequest extends FormRequest
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
            'name' => 'required|string|max:255', 
            'description' => 'required|string|max:1000',
            'email' => 'required|email|max:255|unique:users,email', 
            'place_id' => 'integer|required|exists:places,id'
   
     ] ;}
}
