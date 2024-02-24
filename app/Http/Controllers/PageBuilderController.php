<?php

namespace App\Http\Controllers;

use App\Models\SitePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageBuilderController extends Controller
{
    public function index()
    {
        return view('page-builder.index');
    }

    public function show($id)
    {
        return view('page-builder.show', ['page' => SitePage::findOrFail($id)]);
    }

    public function save(Request $request, $page)
    {
        $page = SitePage::where('id', $page)->firstOrFail();
        $items = $request->except('language_id');
        foreach ($items as $key => $item) {
            if (isset($item['image']) && strpos($item['image'], 'data:')) {
                $decodedData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $item['image']));
                $filename = mt_rand(1, 1000) . '-' . $key . time() . '.jpg';
                Storage::disk('public')->put($filename, $decodedData);
                $fileUrl = Storage::disk('public')->url($filename);
                $items[$key]['image'] = $fileUrl;
            }
        }
        $page->builder_content = $items;
        $page->save();
        return to_route('site-pages.index');
    }
}
