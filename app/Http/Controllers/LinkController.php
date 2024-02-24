<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Helpers\DeleteRow;
use App\Http\Requests\LinkRequest;
use App\Interface\LinkInterface;
use App\Models\Link;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LinkController extends Controller
{
    private $link;

    public function __construct(LinkInterface $link)
    {
        $this->link = $link;

        $this->middleware('permission:link-read|link-create|link-update|link-delete', ['only' => ['index']]);
        $this->middleware('permission:link-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:link-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:link-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $results = Link::filter()->paginate();
        $projects = Project::all();
        return view('links.index', compact('results', 'projects'));
    }

    public function create()
    {
        $users = User::all();
        return view('links.create', compact('users'));

    }

    public function store(LinkRequest $request)
    {
        $data = $request->validated();
        $this->link->store($data);
        return redirect()->back()->with('success', __('Link created successfully.'));
    }

    public function edit($link_id)
    {
        $result = $this->link->edit($link_id);
        $users = User::all();
        return view('links.edit', compact('result', 'users'));
    }

    public function update(LinkRequest $request, $link_id)
    {
        $data = $request->validated();
        $this->link->update($data, $link_id);
        return redirect()->route('links.index')->with('success', __('Link updated successfully.'));
    }

    public function destroy($link_id)
    {
        $this->link->destroy($link_id);
        return back()->with('success', __('Link deleted successfully.'));
    }
    public function deleteSelectRow(Request $request)
    {
        $selectedRows = $request->input('selectedRows');
        if ($selectedRows == null) {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(Link::class, $selectedRows);
        return back()->with('success', __('Link deleted successfully.'));

    }
    public function export()
    {
        $array = [
            __('ID'),
            __('Code'),
            __('URL'),
            __('Project Name'),
            __('Platform'),
        ];
        $data = Link::select('links.id', 'code', 'url', 'projects.name as project_name', 'platform')
            ->leftJoin('projects', 'links.project_id', 'projects.id')
            ->filter()->get();
        return Excel::download(new exportToExcel($data, $array), 'Links.csv');
    }

    public function generate()
    {
        $project = Project::findOrFail(request()->id);
        Link::generate($project, request()->count);
        return redirect()->back()->with('success', __('Links generated successfully.'));
    }
}
