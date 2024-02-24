<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|integer',
            'tag_id' => 'required|integer',
            'continent' => 'required|string',
            'country_id' => 'required|integer',
            'project_id' => 'required|integer',
            'project_code' => 'required|string',
            'price' => 'required|numeric|max:9999999.99',
            'quantity' => 'required|integer|max:100000',
            'amount' => 'required|numeric|max:9999999.99',
            'comment' => 'nullable|string',
        ];
    }
}
