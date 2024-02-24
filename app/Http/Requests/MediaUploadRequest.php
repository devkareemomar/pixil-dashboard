<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaUploadRequest extends FormRequest
{
    public function rules()
    {
        return [
            'image' => 'required_without:video|mimes:jpeg,png,gif|max:20480',
            'video' => 'required_without:image|mimes:mp4,avi,flv,mov|max:20480',
        ];
    }
}
