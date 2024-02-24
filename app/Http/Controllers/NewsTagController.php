<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Helpers\DeleteRow;
use App\Http\Requests\NewsTagRequest;
use App\Interface\NewsTagInterface;
use App\Models\NewsTag;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class NewsTagController extends Controller
{
    private $tag;

    public function __construct(NewsTagInterface $tag)
    {
        $this->middleware('permission:news tag-read|news tag-create|news tag-update|news tag-delete', ['only' => ['index']]);
        $this->middleware('permission:news tag-create', ['only' => ['create','store']]);
        $this->middleware('permission:news tag-update', ['only' => ['edit','update']]);
        $this->middleware('permission:news tag-delete', ['only' => ['destroy']]);
        $this->tag = $tag;
    }

    public function api()
    {
        return NewsTag::select('name')->get()->pluck('name');
    }

    public function index()
    {
        $results = NewsTag::query()->filter()->paginate();
        return view('news_tags.index', compact('results'));
    }

    public function create()
    {
        return view('news_tags.create');

    }

    public function store(NewsTagRequest $request)
    {
        $this->tag->store($request->validated());
        return redirect()->route('news_tags.index')->with('success',  __('Tag created successfully.'));
    }

    public function edit($tag_id)
    {
        $result = $this->tag->edit($tag_id);
        return view('news_tags.edit', compact('result'));
    }

    public function update(NewsTagRequest $request, $tag_id)
    {
        $this->tag->update($request->validated(), $tag_id);
        return redirect()->route('news_tags.index')->with('success',  __('Tag updated successfully.'));
    }

    public function destroy($tag_id)
    {
        $this->tag->destroy($tag_id);
        return back()->with('success',  __('Tag deleted successfully.'));
    }

    public function deleteSelectRow(Request $request)
    {
        $selectedRows=$request->input('selectedRows');
        if ($selectedRows==null)
        {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(NewsTag::class,$selectedRows);
        return back()->with('success',  __('Tag deleted successfully.'));

    }
    public function export()
    {
        $array = [
            __('ID'),__('Name'),__('Slug')
        ];
        $data = NewsTag::select('id','name','slug')->filter()->get();

        return Excel::download(new exportToExcel($data, $array), 'NewsTags.csv');
    }
}
