<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleStoreRequest extends FormRequest
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
            'title'           => ['required', 'max:255'],
            'slug'            => ['nullable', 'max:255'],
            'body'            => ['required'],
            'image'           => ['nullable', 'image', 'mimetypes:image/jpeg,image/jpg,image/png', 'max:5120'],
            //'image'           => ['image', 'mimes:jpeg,jpg,png', 'max:5120'],
            'tags'            => ['nullable'],
            'seo_keywords'    => ['nullable', 'string'],
            'seo_description' => ['nullable', 'string'],
            'read_time'       => ['nullable', 'integer'],
            'publish_date'    => ['nullable', 'date'],
            'category_id'     => ['nullable', 'integer'],
            'user_id'         => ['nullable', 'integer']
        ];
    }
}
