<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CareerRequest extends FormRequest
{
    public function rules(): array
    {

        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onUpdate()
    {
        $id = $this->route('career');
        return [
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', Rule::unique('careers')->ignore($id)],
            'phone' => ['required', 'numeric','digits_between:8,12','regex:[0-9]', Rule::unique('careers')->ignore($id)],
            'file' => ['nullable', 'mimes:png,jpg,jpeg,webp,ppt,pptx,doc,docx,pdf,xls,xlsx', 'max:204800'],
            'job_category_id' => ['required'],
            'nationality_id' => ['required']
        ];
    }

    protected function onCreate()
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', Rule::unique('careers')],
            'phone' => ['required', 'numeric','digits_between:8,12', Rule::unique('careers')],
            'file' => ['nullable', 'mimes:png,jpg,jpeg,webp,ppt,pptx,doc,docx,pdf,xls,xlsx', 'max:204800'],
            'job_category_id' => ['required'],
            'nationality_id' => ['required']
        ];
    }
}
