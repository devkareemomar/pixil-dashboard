<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsRequest extends FormRequest
{
    public function rules(): array
    {
        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onUpdate()
    {
        $id = $this->route('news');

        return [
            'news' => ['required', 'array'],
            'news.*.title' => ['nullable', 'string', 'min:3', Rule::unique('news')->ignore($id)],
            'news.*.description' => ['nullable', 'min:3'],
            'news.*.short_description' => ['nullable', 'string'],
            'image' => ['nullable', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'categories' => ['nullable'],
            'slug' => ['nullable', 'string', 'max:255'],
            'tags' => ['nullable']
        ];
    }

    protected function onCreate()
    {
        return [
            'news' => ['required', 'array'],
            'news.*.title' => ['nullable', 'string', 'min:3', Rule::unique('news')],
            'news.*.description' => ['nullable', 'min:3'],
            'news.*.short_description' => ['nullable', 'string'],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'categories' => ['nullable'],
            'slug' => ['nullable', 'string', 'max:255'],
            'tags' => ['nullable']
        ];
    }
}
