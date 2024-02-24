<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Models\SocialMedia;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:settings-update', ['only' => ['index', 'update']]);
    }

    public function index()
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([]);
        }

        $social_medias = SocialMedia::all();

        return view('settings.index', compact('setting', 'social_medias'));
    }

    public function update(SettingRequest $request)
    {
        $settings = Setting::firstOrFail();

        $data = $request->validated();

        if ($request->hasFile('application_logo_image')) {
            $data['application_logo_image'] = $request->file('application_logo_image')->store('application_logo_images', 'public');
        }

        if ($request->hasFile('dark_application_logo_image')) {
            $data['dark_application_logo_image'] = $request->file('dark_application_logo_image')->store('dark_application_logo_images', 'public');
        }
        if ($request->hasFile('mobile_logo_image')) {
            $data['mobile_logo_image'] = $request->file('mobile_logo_image')->store('mobile_logo_image', 'public');
        }


        if ($request->hasFile('custom_css_file')) {
            $data['custom_css_file'] = $request->file('custom_css_file')->store('custom_css_files', 'public');
        }

        $settings->update($data);

        return redirect()->route('settings.index')->with('success', __('Settings updated successfully.'));
    }
}
