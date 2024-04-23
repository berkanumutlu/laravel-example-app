<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
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
            'slug'            => ['max:255', 'unique:articles,id,'.$this->id],
            'body'            => ['required'],
            'tags'            => ['nullable'],
            'seo_keywords'    => ['nullable', 'string'],
            'seo_description' => ['nullable', 'string'],
            'read_time'       => ['nullable', 'integer'],
            'publish_date'    => ['nullable', 'date'],
            'category_id'     => ['nullable', 'integer']
        ];
    }
}
