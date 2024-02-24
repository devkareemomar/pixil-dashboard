<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HelpListRequest extends FormRequest
{
    public function rules(): array
    {

        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onUpdate()
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'service_status' => ['nullable', 'string', 'min:3'],
            'gender' => ['required', 'string', 'min:3'],
            'help_type_id' => ['required'],
            'marital_status' => ['required', 'string', 'min:3'],
            'civil_id' => ['required', 'numeric'],
            'family_members' => ['required', 'numeric'],
            'job' => ['nullable', 'string', 'min:3'],
            'salary' => ['nullable', 'numeric'],
            'address' => ['required', 'string', 'min:3'],
            'other_information' => ['nullable', 'string', 'min:3'],
            'phone' => ['required', 'numeric'],
            'old_help_document' => ['nullable', 'string', 'min:3'],
            'reference_no' => ['nullable', 'numeric'],
            'file' => ['nullable', 'mimes:png,jpg,jpeg,webp,ppt,pptx,doc,docx,pdf,xls,xlsx', 'max:204800'],
            'nationality_id' => ['required']
        ];
    }

    protected function onCreate()
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'service_status' => ['nullable', 'string', 'min:3'],
            'gender' => ['required', 'string', 'min:3'],
            'help_type_id' => ['required'],
            'marital_status' => ['required', 'string', 'min:3'],
            'civil_id' => ['required', 'numeric'],
            'family_members' => ['required', 'numeric'],
            'job' => ['nullable', 'string', 'min:3'],
            'salary' => ['nullable', 'numeric'],
            'address' => ['required', 'string', 'min:3'],
            'other_information' => ['nullable', 'string', 'min:3'],
            'phone' => ['required', 'numeric'],
            'old_help_document' => ['nullable', 'string', 'min:3'],
            'reference_no' => ['nullable', 'numeric'],
            'file' => ['nullable', 'mimes:png,jpg,jpeg,webp,ppt,pptx,doc,docx,pdf,xls,xlsx', 'max:204800'],
            'nationality_id' => ['required']
        ];
    }
}
