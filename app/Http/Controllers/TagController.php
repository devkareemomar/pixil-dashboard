<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Helpers\DeleteRow;
use App\Http\Requests\TagRequest;
use App\Interface\TagInterface;
use App\Models\Tag;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TagController extends Controller
{
    private $tag;

    public function __construct(TagInterface $tag)
    {
        $this->middleware('permission:tag-read|tag-create|tag-update|tag-delete', ['only' => ['index']]);
        $this->middleware('permission:tag-create', ['only' => ['create','store']]);
        $this->middleware('permission:tag-update', ['only' => ['edit','update']]);
        $this->middleware('permission:tag-delete', ['only' => ['destroy']]);
        $this->tag = $tag;
    }

    public function api()
    {
        return Tag::select('name')->get()->pluck('name');
    }

    public function index()
    {
        $results = Tag::query()->filter()->paginate();
        return view('tags.index', compact('results'));
    }

    public function create()
    {
        return view('tags.create');

    }

    public function store(TagRequest $request)
    {
        $this->tag->store($request->validated());
        return redirect()->route('tags.index')->with('success',  __('Tag created successfully.'));
    }

    public function edit($tag_id)
    {
        $result = $this->tag->edit($tag_id);
        return view('tags.edit', compact('result'));
    }

    public function update(TagRequest $request, $tag_id)
    {
        $this->tag->update($request->validated(), $tag_id);
        return redirect()->route('tags.index')->with('success',  __('Tag updated successfully.'));
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
        DeleteRow::helperDeleteSelectedRows(Tag::class,$selectedRows);
        return back()->with('success',  __('Tag deleted successfully.'));

    }
    public function export()
    {
        $array = [
            __('ID'),
            __('Name'),
            __('Slug'),
        ];
        $data = Tag::select('id','name','slug')->filter()->get();

        return Excel::download(new exportToExcel($data, $array), 'ProjectTags.csv');
    }
}
