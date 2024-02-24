<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onUpdate()
    {
        $id = $this->route('user') ?: auth()->user()->id;
        return [
            'name' => ['nullable', 'string', 'min:3'],
            'first_name' => ['nullable', 'alpha', 'min:3'],
            'last_name' => ['nullable', 'alpha', 'min:3'],
            'email' => ['nullable', 'email', Rule::unique('users')->ignore($id)],
            'username' => ['nullable', 'alpha_dash', Rule::unique('users')->whereNot('id', $id)],
            'phone' => ['nullable', 'numeric', Rule::unique('users')->ignore($id)],
            'password' => ['nullable', 'min:8', 'different:username,email'],
            'photo' => ['nullable', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'role_id' => ['required', 'exists:roles,id'],
        ];
    }

    protected function onCreate()
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users')],
            'username' => ['nullable', 'alpha_dash', Rule::unique('users')],
            'phone' => ['nullable', 'numeric', Rule::unique('users')],
            'password' => ['required', 'min:8', 'different:username,email'],
            'photo' => ['nullable', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'role_id' => ['required', 'exists:roles,id'],
        ];
    }
}
