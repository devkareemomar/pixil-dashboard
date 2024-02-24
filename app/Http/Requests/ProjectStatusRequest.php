<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectStatusRequest extends FormRequest
{
    public function rules(): array
    {

        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onUpdate()
    {
        $id = $this->route('projectStatus');
        return [
            'name' => ['required', 'string', 'min:3', Rule::unique('project_statuses')->ignore($id)],
            'description' => ['required', 'min:3'],
            'is_new' => ['nullable'],
            'is_active' => ['nullable'],
            'is_completed' => ['nullable']
        ];
    }

    protected function onCreate()
    {
        return [
            'name' => ['required', 'string', 'min:3', Rule::unique('project_statuses')],
            'description' => ['required', 'min:3'],
            'is_new' => ['nullable'],
            'is_active' => ['nullable'],
            'is_completed' => ['nullable']
        ];
    }
}
