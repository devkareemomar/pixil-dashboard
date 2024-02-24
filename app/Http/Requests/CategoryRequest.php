<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {

        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onUpdate()
    {
        $id = $this->route('category');
        if (!$id)
            $id = $this->route('division');

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($id)],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('categories')->ignore($id)],
            'featured' => ['boolean'],
            'parent_category' => ['nullable', 'exists:categories,id'],
//            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
//            'icon' => ['nullable', 'image', 'mimes:ico,png', 'max:64'],
        ];
    }

    protected function onCreate()
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('categories')],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('categories')],
            'featured' => ['boolean'],
            'parent_category' => ['nullable', 'exists:categories,id'],
            // 'image' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            // 'icon' => ['required', 'image', 'mimes:ico,png', 'max:64'],
        ];
    }
}
