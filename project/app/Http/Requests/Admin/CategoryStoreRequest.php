<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
            //'title' => 'required|unique:categories|max:255|in:active,passive',
            "name"            => ['required', 'min:3', 'max:255'],
            "slug"            => ['max:255'],
            "image"           => ['nullable', 'image', 'mimetypes:image/jpeg,image/jpg,image/png', 'max:5120'],
            "description"     => ['max:255'],
            "seo_keywords"    => ['max:255'],
            "seo_description" => ['max:255']
        ];
    }

    public function messages()
    {
        return [
            "name.required"       => "Kategori Adı gerekli.",
            "name.max"            => "Kategori Adı en fazla :max karakter olabilir.",
            "description.max"     => "Kategori açıklaması en fazla :max karakter olabilir.",
            "seo_keywords.max"    => "Kategori :attribute en fazla :max karakter olabilir.",
            "seo_description.max" => "Kategori :attribute en fazla :max karakter olabilir."
        ];
    }
}
