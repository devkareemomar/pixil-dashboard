<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GiftTemplateRequest extends FormRequest
{
    public function rules(): array
    {

        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();


    }


    protected function onCreate()
    {
        return [

            'watermark_image' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'original_image' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
         ];
    }

    protected function onUpdate()
    {
        return [

            'watermark_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'original_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
         ];
    }


}
