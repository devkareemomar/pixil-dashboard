<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CurrencyRequest extends FormRequest
{
    public function rules(): array
    {
        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onUpdate()
    {
        $id = $this->route('currency');

        return [
            'currencies' => ['required', 'array'],
            'currencies.*.name' => ['required', 'string', 'max:255', Rule::unique('currencies')->ignore($id)],
            'code' => ['required', 'string', 'size:3', Rule::unique('currencies')->ignore($id)],
            'exchange_rate' => ['required', 'numeric', 'min:0'],
        ];
    }

    protected function onCreate()
    {
        return [
            'currencies' => ['required', 'array'],
            'currencies.*.name' => ['required', 'string', 'max:255', Rule::unique('currencies')],
            'code' => ['required', 'string', 'size:3', Rule::unique('currencies')],
            'exchange_rate' => ['required', 'numeric', 'min:0'],
        ];
    }
}
