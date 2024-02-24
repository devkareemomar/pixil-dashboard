<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LinkRequest extends FormRequest
{
    public function rules(): array
    {

        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onUpdate()
    {
        $id = $this->route('link');
        return [
            'code' => ['required', 'string', 'min:3', Rule::unique('links')->ignore($id)],
            'project_id' => ['nullable'],
            'url' => ['nullable','url'],
            'platform' => ['nullable'],
            'is_project' => ['nullable'],
            'user_id' => ['nullable']
        ];
    }

    protected function onCreate()
    {
        return [
            'code' => ['required', 'string', 'min:3', Rule::unique('links')],
            'project_id' => ['nullable'],
            'url' => ['nullable','url'],
            'platform' => ['nullable'],
            'is_project' => ['nullable'],
            'user_id' => ['nullable']
        ];
    }
}
