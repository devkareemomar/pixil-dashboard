<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FormBuilderRequest extends FormRequest
{
    public function rules(): array
    {
        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onUpdate()
    {
        $id = $this->route('form');
        return [
            'project_id' => ['required'],
            'status_name' => ['required', Rule::unique('form_builders')->ignore($id)],
            'form_data' => ["required", 'json'],
            'active' => ['nullable'],
            'locale' => 'required',
        ];
    }

    protected function onCreate()
    {
        return [
            'project_id' => ['required'],
            'status_name' => ['required', Rule::unique('form_builders')],
            'form_data' => ["required", 'json'],
            'active' => ['nullable'],
            'locale' => 'required',
        ];
    }
}
