<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageRequest extends FormRequest
{
    public function rules(): array
    {
        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onUpdate()
    {
        $id = $this->route('page');

        return [
            'project_id' => ['nullable'],
            'name' => ["nullable", Rule::unique('pages')->ignore($id)],
            'title' => ['nullable'],
            'description' => ['nullable'],
            'metadata' => ['nullable'],
        ];
    }

    protected function onCreate()
    {
        return [
            'project_id' => ['required'],
            'name' => ["required", Rule::unique('pages')],
            'title' => ['required'],
            'description' => ['required'],
            'metadata' => ['nullable'],
        ];
    }
}
