<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    public function rules(): array
    {
        return request()->isMethod('put') || request()->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }

    protected function onUpdate()
    {
        $id = $this->route('project');
        return [
            'projects.*.name' => ['nullable', 'string', 'min:3', Rule::unique('projects', 'name')->ignore($id)],
            'projects.*.slug' => ['nullable', 'string', Rule::unique('projects', 'slug')->ignore($id)],
            'projects.*.description' => ['nullable', 'string'],
            'projects.*.short_description' => ['nullable', 'string'],
            'sku' => ['nullable', 'string'],
            'creator_id' => ['nullable', 'integer'],
            'total_earned' => ['nullable', 'numeric'],
            'total_wanted' => ['nullable', 'numeric'],
            'share_value' => ['nullable', 'numeric'],
            'project_status_id' => ['nullable', 'integer', 'exists:project_statuses,id'],
            'featured' => ['nullable', 'integer', Rule::in([0, 1])],
            'thumbnail' => ['nullable'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after:start_date'],
            'visibility' => ['nullable'],
            'accept_donation' => ['nullable'],
            'show_in_home_page' => ['nullable'],
            'show_in_shop' => ['nullable'],
            'is_gift' => ['nullable'],
            'category_id' => ['nullable', 'integer'],
            'sub_category_id' => ['nullable', 'integer'],
            'amount_variant' => ['nullable'],
            'active' => ['nullable'],
            'show_in_menu' => ['nullable'],
            'hidden' => ['nullable'],
            'donation_available' => ['nullable'],
            'countries.*.id' => ['nullable', 'integer', 'exists:countries,id', 'distinct'],
            'countries.*.total_wanted' => ['nullable', 'numeric'],
            'countries.*.share_value' => ['nullable', 'numeric'],
            'countries' => ['nullable', 'array'],
            'country_id' => ['nullable', 'integer'],
            'show_donation_comment' => ['nullable'],
            'donation_comment' => ['nullable', 'string'],
            'is_zakat' => ['nullable'],
            'show_donor_phone' => ['nullable'],
            'donor_phone_required' => ['nullable'],
            'show_donor_name' => ['nullable'],
            'donor_name_required' => ['nullable'],
            'show_banner' => ['nullable'],
            'is_continuous' => ['nullable'],
            'is_full_unit' => ['nullable'],
            'is_multi_country' => ['nullable'],
            'is_stock' => ['nullable'],
            'is_quick_donation' => ['nullable'],
            'unit_value' => ['nullable'],
            'stock' => ['nullable'],
            'show_timer' => ['nullable'],
            'show_target_amount' => ['nullable'],
            'show_paid_amount' => ['nullable'],
            'show_percentage' => ['nullable'],
            'main_image' => ['nullable'],
            'banner_image' => ['nullable'],
            'highlighted' => ['nullable'],
            'suggested_values' => ['nullable'],
            'suggested_label' => ['nullable'],
            'is_project_case' => ['nullable'],
            'order' => ['nullable', 'numeric'],
            'video' => ['nullable']

        ];
    }

    protected function onCreate()
    {
        // $projects[$default_language->id]['name']
        return [
            'projects.*.name' => ['nullable', 'string', 'min:3', Rule::unique('projects', 'name')],
            'projects.*.slug' => ['nullable', 'string', Rule::unique('projects', 'slug')],
            'projects.*.description' => ['nullable', 'string'],
            'projects.*.short_description' => ['nullable', 'string'],
            'sku' => ['nullable', 'string'],
            'creator_id' => ['nullable', 'integer'],
            'total_earned' => ['nullable', 'numeric'],
            'total_wanted' => ['nullable', 'numeric'],
            'share_value' => ['nullable', 'numeric'],
            'project_status_id' => ['nullable', 'integer', 'exists:project_statuses,id'],

            'featured' => ['nullable', 'integer', Rule::in([0, 1])],
            'thumbnail' => ['nullable', 'image'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after:start_date'],
            'visibility' => ['nullable'],
            'accept_donation' => ['nullable'],
            'show_in_home_page' => ['nullable'],
            'show_in_shop' => ['nullable'],
            'is_gift' => ['nullable'],
            'category_id' => ['nullable', 'integer'],
            'sub_category_id' => ['nullable', 'integer'],
            'amount_variant' => ['nullable'],
            'active' => ['nullable'],
            'show_in_menu' => ['nullable'],
            'hidden' => ['nullable'],
            'donation_available' => ['nullable'],
            'country_id' => ['nullable', 'integer'],
            'countries.*.id' => ['nullable', 'integer', 'exists:countries,id', 'distinct'],
            'countries.*.total_wanted' => ['nullable', 'numeric'],
            'countries.*.share_value' => ['nullable', 'numeric'],
            'countries' => ['nullable', 'array'],
            'show_donation_comment' => ['nullable'],
            'donation_comment' => ['nullable', 'string'],
            'is_zakat' => ['nullable'],
            'show_donor_phone' => ['nullable'],
            'donor_phone_required' => ['nullable'],
            'show_donor_name' => ['nullable'],
            'donor_name_required' => ['nullable'],
            'show_banner' => ['nullable'],
            'is_continuous' => ['required'],
            'is_full_unit' => ['nullable'],
            'is_multi_country' => ['nullable'],
            'is_stock' => ['nullable'],
            'is_quick_donation' => ['nullable'],
            'unit_value' => ['nullable'],
            'stock' => ['nullable'],
            'show_timer' => ['required'],
            'show_target_amount' => ['required'],
            'show_paid_amount' => ['required'],
            'show_percentage' => ['required'],
            'main_image' => ['nullable', 'image'],
            'banner_image' => ['nullable', 'image'],
            'highlighted' => ['nullable'],
            'suggested_values' => ['nullable'],
            'is_project_case' => ['nullable'],
            'order' => ['nullable', 'numeric'],
            'video' => ['nullable']

        ];
    }
}
