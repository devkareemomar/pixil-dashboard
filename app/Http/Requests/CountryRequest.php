<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryRequest extends FormRequest
{
    public function rules(): array
    {
        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onUpdate()
    {
        $id = $this->route('country');

        return [
            'countries' => ['required', 'array'],
            'countries.*.name' => ['nullable', 'string', 'min:2', Rule::unique('countries')->ignore($id)],
            'short_name' => ['nullable', 'string', 'max:3', Rule::unique('countries')->ignore($id)],
            'flag' => ['nullable', 'image', 'mimes:png,ico,svg,webp',],
            'language_id' => 'required|exists:languages,id',
            'currency_id' => 'required|exists:currencies,id',
        ];
    }

    protected function onCreate()
    {
        return [
            'countries' => ['required', 'array'],
            'countries.*.name' => ['required', 'string', 'min:2', Rule::unique('countries')],
            'short_name' => ['required', 'string', 'max:3', Rule::unique('countries')],
            'flag' => [
                'required',
                'image',
                'dimensions:min_width=32,min_height=32,max_width=64,max_height=64',
                'mimes:png,ico,svg,webp',
            ],
            'language_id' => 'required|exists:languages,id',
            'currency_id' => 'required|exists:currencies,id',
        ];
    }
}
