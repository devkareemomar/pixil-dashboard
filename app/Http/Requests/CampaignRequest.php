<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CampaignRequest extends FormRequest
{
    public function rules(): array
    {

        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onUpdate()
    {
        $id = $this->route('campaign');
        return [
            'campaigns' => ['required', 'array'],
            'campaigns.*.title' => ['required', 'string', 'min:3', Rule::unique('campaigns')->ignore($id)],
            'campaigns.*.description' => ['required', 'min:3'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'campaigns.*.slogan' => ['nullable', 'string'],
            'projects' => ['nullable'],
            'is_active' => ['nullable'],
            'is_home_slider' => ['nullable']
        ];
    }

    protected function onCreate()
    {
        return [
            'campaigns' => ['required', 'array'],
            'campaigns.*.title' => ['required', 'string', 'min:3', Rule::unique('campaigns')],
            'campaigns.*.description' => ['required', 'min:3'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'campaigns.*.slogan' => ['nullable', 'string'],
            'projects' => ['nullable'],
            'is_active' => ['nullable'],
            'is_home_slider' => ['nullable']
        ];
    }
}
