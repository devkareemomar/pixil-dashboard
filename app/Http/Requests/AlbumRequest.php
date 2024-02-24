<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlbumRequest extends FormRequest
{
    public function rules(): array
    {

        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onUpdate()
    {
        $id = $this->route('album');
        return [
            'albums.*.title' => ['required', 'string', 'min:3', Rule::unique('album_languages')->ignore($id, 'album_id')],
            'albums.*.description' => ['required', 'min:3'],
            'is_active' => ['nullable'],
            'images'=>['nullable'],
            'images.*' =>['nullable','mimes:jpeg,jpg,png,gif'],
            'videos.*'=>['nullable', 'url' ]

        ];
    }

    protected function onCreate()
    {

        return [
            'albums.*.title' => ['required', 'string', 'min:3', Rule::unique('album_languages')],
            'albums.*.description' => ['required', 'min:3'],
            'is_active' => ['nullable'],
            'images.*' =>['nullable','mimes:jpeg,jpg,png,gif'],
            'videos.*'=>['nullable', 'url' ]

        ];
    }
}
