<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuRequest extends FormRequest
{
    public function rules(): array
    {
        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onUpdate()
    {
        $id = $this->route('menu');
        return [
            'name' => ['required', Rule::unique('menus')->ignore($id)],
            'location' => ['required'],
            'projects' => ['array'],
            'projects.orders.*' => ['nullable', 'integer', 'min:0', 'max:255'],
            'pages' => ['array'],
            'pages.orders.*' => ['nullable', 'integer', 'min:0', 'max:255'],

        ];
    }

    protected function onCreate()
    {
        return [
            'name' => ['required', 'string', Rule::unique('menus', 'name')],
            'location' => ['required'],
            'projects' => ['array'],
            'projects.orders.*' => ['nullable', 'integer', 'min:0', 'max:255'],
            'pages' => ['array'],
            'pages.orders.*' => ['nullable', 'integer', 'min:0', 'max:255'],
        ];
    }
}
