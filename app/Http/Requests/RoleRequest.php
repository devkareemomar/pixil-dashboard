<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    public function rules(): array
    {
        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onUpdate()
    {
        $id = $this->route('role');

        return [
            'name' => ['nullable', Rule::unique('roles')->ignore($id), 'regex:/^[ a-zA-Z0-9_-]*$/', 'max:20'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['integer', 'exists:permissions,id'],
        ];
    }

    protected function onCreate()
    {
        return [
            'name' => ['required', Rule::unique('roles'), 'regex:/^[ a-zA-Z0-9_-]*$/', 'max:20'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['integer', 'exists:permissions,id'],
        ];
    }
}
