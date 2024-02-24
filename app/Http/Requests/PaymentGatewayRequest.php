<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentGatewayRequest extends FormRequest
{
    public function rules(): array
    {
        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onUpdate()
    {
        $id = $this->route('payment_gateway');

        return [
            'name' => ['required', 'string', 'min:3', Rule::unique('payment_gateways')->ignore($id)],
            'description' => ['nullable', 'string', 'min:3'],
            'status' => ['nullable', 'boolean'],
            'api_key' => ['nullable', 'string'],
            'secret_key' => ['nullable', 'string'],
            'redirect_url' => ['nullable', 'string'],
            'cancel_url' => ['nullable', 'string']
        ];
    }

    protected function onCreate()
    {
        return [
            'name' => ['required', 'string', 'min:3', Rule::unique('payment_gateways')],
            'description' => ['nullable', 'string', 'min:3'],
            'status' => ['nullable', 'boolean'],
            'api_key' => ['nullable', 'string'],
            'secret_key' => ['nullable', 'string'],
            'redirect_url' => ['nullable', 'string'],
            'cancel_url' => ['nullable', 'string']

        ];
    }
}
