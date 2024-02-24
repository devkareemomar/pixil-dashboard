<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HelpTypeRequest extends FormRequest
{
    public function rules(): array
    {

        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onCreate()
    {
        return [
            'name' => ['required', 'string', 'min:3', Rule::unique('help_types')],
            'is_active' => ['nullable']
        ];
    }

    protected function onUpdate()
    {
        $id = $this->route('help_type');
        return [
            'name' => ['required', 'string', 'min:3', Rule::unique('help_types')->ignore($id)],
            'is_active' => ['nullable']
        ];
    }
}
