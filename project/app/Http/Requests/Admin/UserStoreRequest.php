<?php

namespace App\Http\Requests\Admin;

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
            "name"        => ['required', 'min:3', 'max:255'],
            "email"       => ['email', 'required', 'unique:users'],
            "username"    => ['required', 'max:255', 'unique:users'],
            "password"    => [
                'required', \Illuminate\Validation\Rules\Password::min(8)->letters()->numbers()->symbols()->mixedCase()
            ],
            "image"       => ['nullable', 'image', 'mimetypes:image/jpeg,image/jpg,image/png', 'max:5120'],
            "title"       => ['max:255'],
            "description" => ['max:255'],
        ];
    }
}
