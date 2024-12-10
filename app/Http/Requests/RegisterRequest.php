<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username'=>['required','unique:users,username'],
            'email'=>['required','email','unique:users,email'],
            'password'=>['required','confirmed','min:8']
        ];
    }

    public function messagues(): array
    {
        return [
            'username.required'=>'username field must be filled',
            'email.required'=>'email field must be filled',
            'email.email'=>'email must be valid',
            'password.confirmed'=>'password and password confirmation fields must be euqal',
            'password.required'=>'password field must be filled',
            'password.min'=>'password must be atleast 8 character long'
        ];
    }
}
