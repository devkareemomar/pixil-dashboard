<?php

namespace App\Http\Controllers;

use App\Helpers\DeleteRow;
use App\Http\Requests\StorePageRequest;
use App\Models\Language;
use App\Models\SitePage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SitePageController extends Controller
{
    public function index()
    {
        return view('site_pages.index', [
            'pages' => SitePage::with('user')
                ->select('id', 'title', 'user_id', 'status', 'key', 'lang')
                ->filter()
                ->orderBy('key')
                ->paginate(20),
        ]);
    }

    public function create()
    {
        return view('site_pages.create', ['page' => null, 'languages' => Language::all()]);
    }

    public function store(StorePageRequest $request)
    {
        $data = $request->validated();
        $data['key'] = Str::slug($data['title']);
        $data['user_id'] = auth()->id();

        SitePage::create($data);

        return to_route('site-pages.index');
    }

    public function destroy(SitePage $sitePage)
    {
        $sitePage->delete();

        return to_route('site-pages.index');
    }

    public function deleteSelectRow(Request $request)
    {
        $selectedRows=$request->input('selectedRows');
        if ($selectedRows==null)
        {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(SitePage::class, $selectedRows);
        return back()->with('success', __('Site Page deleted successfully.'));

    }

    public function duplicate()
    {
        SitePage::findOrFail(request()->id)->replicate()->save();
        return back()->with('success', __('Site Page duplicated successfully.'));
    }

    public function activate()
    {
        $sitPage = SitePage::findOrFail(request()->id);
        if ($sitPage->status == 'published') {
            $sitPage->status = 'unpublished';
        } else {
            $sitPage->status = 'published';
        }
        $sitPage->save();
        return back()->with('success', __('Site Page status changed successfully.'));
    }
}
