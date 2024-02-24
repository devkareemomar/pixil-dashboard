<?php

namespace App\Http\Controllers;

use App\Helpers\DeleteRow;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class DivisionController extends Controller
{

    public function __construct(protected CategoryRepository $categoryRepository)
    {
        $this->middleware('permission:division-read|division-create|division-update|division-delete', ['only' => ['index']]);
        $this->middleware('permission:division-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:division-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:division-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $divisions = Category::divisions()->filter()->paginate();
        return view('divisions.index', compact('divisions'));
    }

    public function show($id)
    {
        $category = $this->categoryRepository->find($id);
        return view('divisions.show', compact('category'));
    }

    public function create()
    {
        $parentCategories = $this->categoryRepository->query()->whereNull('parent_category')->get();
        return view('divisions.create', compact('parentCategories'));
    }

    public function store(CategoryRequest $request)
    {
        $request->validate([
            'parent_category' => 'required',
        ]);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('icons', 'public');
        }

        $this->categoryRepository->create($data);
        return redirect()->route('divisions.index')->with('success', __('Division created successfully.'));
    }

    public function edit($id)
    {
        $division = $this->categoryRepository->find($id);
        $parentCategories = $this->categoryRepository
            ->query()
            ->whereNull('parent_category')
            ->where('id', '!=', $division->id)
            ->get();

        return view('divisions.edit', compact('division', 'parentCategories'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $request->validate([
            'parent_category' => 'required',
        ]);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('icons', 'public');
        }

        $this->categoryRepository->update($id, $data);
        return redirect()->route('divisions.index')->with('success', __('Division updated successfully.'));
    }

    public function destroy($id)
    {
        $this->categoryRepository->delete($id);
        return redirect()->route('divisions.index')->with('success', __('Division deleted successfully.'));
    }

    public function deleteSelectRow(Request $request)
    {
        $selectedRows=$request->input('selectedRows');
        if ($selectedRows==null)
        {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(Category::class, $selectedRows);
        return back()->with('success', __('Division deleted successfully.'));
    }
}
