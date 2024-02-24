<?php

namespace App\Http\Controllers;

use App\Helpers\DeleteRow;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Models\Project;
use App\Repositories\PageRepository;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;

        $this->middleware('permission:page-read|page-create|page-update|page-delete', ['only' => ['index']]);
        $this->middleware('permission:page-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:page-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:page-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $pages = Page::filter()->paginate();
        $projects = Project::all();
        return view('pages.index', compact('pages','projects'));
    }

    public function show($id)
    {
        $page = $this->pageRepository->find($id);
        return view('pages.show', compact('page'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('pages.create', compact('projects'));
    }

    public function store(PageRequest $request)
    {
        $this->pageRepository->create($request->validated());
        return redirect()->route('pages.index')->with('success',  __('Page created successfully.'));
    }

    public function edit($id)
    {
        $page = $this->pageRepository->find($id);
        $projects = Project::all();
        return view('pages.edit', compact('page','projects'));
    }

    public function update(PageRequest $request, $id)
    {
        $this->pageRepository->update($id, $request->validated());
        return redirect()->route('pages.index')->with('success',  __('Page updated successfully.'));
    }

    public function destroy($id)
    {
        $this->pageRepository->delete($id);
        return redirect()->route('pages.index')->with('success',  __('Page deleted successfully.'));
    }

    public function deleteSelectRow(Request $request)
    {
        $selectedRows=$request->input('selectedRows');
        if ($selectedRows==null)
        {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(Page::class, $selectedRows);
        return back()->with('success', __('Page deleted successfully.'));
    }
}
