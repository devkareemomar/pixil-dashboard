<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LanguageRequest extends FormRequest
{
    public function rules(): array
    {
        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onUpdate()
    {
        $id = $this->route('language');

        return [
            'name' => ['nullable', 'string', 'min:2', Rule::unique('languages')->ignore($id)],
            'short_name' => ['nullable', 'string', 'max:3', Rule::unique('languages')->ignore($id)],
            'flag' => [
                'nullable',
                'image',
                // 'dimensions:min_width=32,min_height=32,max_width=64,max_height=64',
                'mimes:png,ico',
            ],
            'is_default' => ['nullable', 'boolean'],
            'translation_file' => ['nullable', 'file']
        ];
    }

    protected function onCreate()
    {
        return [
            'name' => ['required', 'string', 'min:2', Rule::unique('languages')],
            'short_name' => ['required', 'string', 'max:3', Rule::unique('languages')],
            'flag' => [
                'required',
                'image',
                // 'dimensions:min_width=32,min_height=32,max_width=64,max_height=64',
                'mimes:png,ico',
            ],
            'is_default' => ['nullable', 'boolean'],
            'translation_file' => ['nullable', 'file']
        ];
    }
}
