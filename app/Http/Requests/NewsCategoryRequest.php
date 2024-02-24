<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsCategoryRequest extends FormRequest
{
    public function rules(): array
    {

        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onUpdate()
    {
        $id = $this->route('news_category');
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('news_categories', 'name')->ignore($id)],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('news_categories', 'slug')->ignore($id)],
            'featured' => ['boolean'],
            // 'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            // 'icon' => ['nullable', 'image', 'mimes:ico,png', 'max:64'],
        ];
    }

    protected function onCreate()
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('news_categories')],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('news_categories')],
            'featured' => ['boolean'],
            // 'image' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            // 'icon' => ['required', 'image', 'mimes:ico,png', 'max:64'],
        ];
    }
}
