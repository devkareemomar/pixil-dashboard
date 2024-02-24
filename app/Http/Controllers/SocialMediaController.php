<?php

namespace App\Http\Controllers;

use App\Helpers\DeleteRow;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index()
    {
        $social_medias = SocialMedia::filter()->paginate();
        return view('social-media.index', compact('social_medias'));
    }

    public function create()
    {
        return view('social-media.create');
    }

    public function edit($id)
    {
        $social_media = SocialMedia::findOrfail($id);
        return view('social-media.edit', compact('social_media'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:social_medias,name',
            'icon' => 'required',
            'url' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('icons', 'public');
        }

        $social_media = SocialMedia::create($data);

        return redirect()->route('social-media.index')
            ->with('success', __('Social media created successfully'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:social_medias,name,' . $id,
            'icon' => 'required',
            'url' => 'required',
        ]);

        $data = $request->all();

        $social_media = SocialMedia::findOrfail($id);

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('icons', 'public');
        }

        $social_media->update($data);

        return redirect()->route('social-media.index')
            ->with('success', __('Social media updated successfully'));
    }

    public function destroy($id)
    {
        $social_media = SocialMedia::findOrfail($id);
        $social_media->delete();

        return redirect()->route('social-media.index')
            ->with('success', __('Social media deleted successfully'));
    }

    public function deleteSelectRow(Request $request)
    {
        $selectedRows = $request->input('selectedRows');
        if ($selectedRows == null) {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(SocialMedia::class, $selectedRows);
        return back()->with('success', __('Social media deleted successfully'));

    }


}
