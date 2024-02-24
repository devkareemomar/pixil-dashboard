<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Helpers\DeleteRow;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{

    public function __construct(protected CategoryRepository $categoryRepository)
    {
        $this->middleware('permission:category-read|category-create|category-update|category-delete', ['only' => ['index']]);
        $this->middleware('permission:category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $categories = Category::query()->parents()->filter()->paginate();
        return view('categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = $this->categoryRepository->find($id);
        return view('categories.show', compact('category'));
    }

    public function create()
    {
        $parentCategories = $this->categoryRepository->query()->whereNull('parent_category')->get();
        return view('categories.create', compact('parentCategories'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('icons', 'public');
        }

        $this->categoryRepository->create($data);
        return redirect()->route('categories.index')->with('success',  __('Category created successfully.'));
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        $parentCategories = $this->categoryRepository
            ->query()
            ->whereNull('parent_category')
            ->where('id', '!=', $category->id)
            ->get();

        return view('categories.edit', compact('category','parentCategories'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('icons', 'public');
        }

        $this->categoryRepository->update($id, $data);
        return redirect()->route('categories.index')->with('success',  __('Category updated successfully.'));
    }

    public function destroy($id)
    {
        $this->categoryRepository->delete($id);
        return redirect()->route('categories.index')->with('success',  __('Category deleted successfully.'));
    }
    public function deleteSelectRow(Request $request)
    {
        $selectedRows=$request->input('selectedRows');
        if ($selectedRows==null)
        {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(Category::class,$selectedRows);
        return back()->with('success',  __('Category deleted successfully.'));

    }
    public function export()
    {
        $array = [
            '#',__('Name'),__('Slug')
        ];
        $data = Category::select('id','name','slug')->filter()->get();

        return Excel::download(new exportToExcel($data, $array), 'ProjectCategories.csv');
    }
}
