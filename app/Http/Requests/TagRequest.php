<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagRequest extends FormRequest
{
    public function rules(): array
    {
        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onUpdate()
    {
        $id = $this->route('tag');

        return [
            'name' => ['nullable', 'string', 'min:3', Rule::unique('tags')->ignore($id)],
            'slug' => ['nullable', 'min:3']

        ];
    }

    protected function onCreate()
    {
        return [
            'name' => ['required', 'string', 'min:3', Rule::unique('tags')],
            'slug' => ['required', 'min:3']

        ];
    }
}
