<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateSocialsRequest extends FormRequest
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
            "website"             => ['nullable', 'url'],
            "socials"             => ['nullable', 'array', 'min:3'],
            "socials.*.social_id" => ['required', 'integer'],
            "socials.*.name"      => ['required', 'string'],
            "socials.*.link"      => ['nullable', 'url']
        ];
    }
}
