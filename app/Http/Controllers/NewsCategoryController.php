<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Helpers\DeleteRow;
use App\Http\Requests\NewsCategoryRequest;
use App\Models\NewsCategory;
use App\Repositories\NewsCategoryRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class NewsCategoryController extends Controller
{

    public function __construct(protected NewsCategoryRepository $categoryRepository)
    {
        $this->middleware('permission:news category-read|news category-create|news category-update|news category-delete', ['only' => ['index']]);
        $this->middleware('permission:news category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:news category-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:news category-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $categories = NewsCategory::query()->filter()->paginate();
        return view('news_categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = $this->categoryRepository->find($id);
        return view('news_categories.show', compact('category'));
    }

    public function create()
    {
        return view('news_categories.create',);
    }

    public function store(NewsCategoryRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('icons', 'public');
        }

        $this->categoryRepository->create($data);
        return redirect()->route('news_categories.index')->with('success',  __('Category created successfully.'));
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);


        return view('news_categories.edit', compact('category'));
    }

    public function update(NewsCategoryRequest $request, $id)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('icons', 'public');
        }

        $this->categoryRepository->update($id, $data);
        return redirect()->route('news_categories.index')->with('success',  __('Category updated successfully.'));
    }

    public function destroy($id)
    {
        $this->categoryRepository->delete($id);
        return redirect()->route('news_categories.index')->with('success',  __('Category deleted successfully.'));
    }
    public function deleteSelectRow(Request $request)
    {
        $selectedRows=$request->input('selectedRows');
        if ($selectedRows==null)
        {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(NewsCategory::class,$selectedRows);
        return back()->with('success',  __('Category deleted successfully.'));

    }
    public function export()
    {
        $array = [
            __('ID'),__('Name'),__('Slug')
        ];
        $data = NewsCategory::select('id','name','slug')->filter()->get();

        return Excel::download(new exportToExcel($data, $array), 'NewsCategories.csv');
    }
}
