<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            "email"       => ['required', 'email', 'unique:users,email,'.$this->id],
            "username"    => ['required', 'max:255', 'unique:users,username,'.$this->id],
            "password"    => ['nullable', \Illuminate\Validation\Rules\Password::min(8)->letters()->numbers()->symbols()->mixedCase()],
            "image"       => ['nullable', 'image', 'mimetypes:image/jpeg,image/jpg,image/png', 'max:5120'],
            "title"       => ['nullable', 'max:255'],
            "description" => ['nullable', 'max:500']
        ];
    }
}
