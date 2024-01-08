<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'first_name'            => ['required', 'min:3', 'max:255'],
            'last_name'             => ['required', 'min:3', 'max:255'],
            'email'                 => ['email', 'required', 'unique:users,email'],
            'username'              => [
                'required', 'max:255', 'unique:users,username',
                //'regex:/^([a-z])+?(-|_)([a-z])+$/i'
                'alpha_dash'
            ],
            'password'              => [
                'required', \Illuminate\Validation\Rules\Password::min(8)->letters()->numbers()->symbols()->mixedCase(),
                'confirmed'
            ],
            'password_confirmation' => [
                'required', \Illuminate\Validation\Rules\Password::min(8)->letters()->numbers()->symbols()->mixedCase()
            ],
            /*'confirm_password'      => [
                'required', 'same:password',
                \Illuminate\Validation\Rules\Password::min(8)->letters()->numbers()->symbols()->mixedCase()
            ]*/
        ];
    }
}
