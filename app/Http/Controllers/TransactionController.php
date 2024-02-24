<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Helpers\DeleteRow;
use App\Http\Requests\TransactionRequest;
use App\Models\Category;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderProject;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:transaction-read|transaction-create|transaction-update|transaction-delete', ['only' => ['index']]);
        $this->middleware('permission:transaction-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:transaction-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:transaction-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $transactions = OrderProject::filter()
        ->when(
            request('filter') && request('filter')['category_id'],
            fn($query) => $query->whereHas('project', function ($query) {
                $query->where('category_id', request()->filter['category_id'] ?? null);
            })
        )
        ->when(
            request('filter') && request('filter')['country_id'],
            fn($query) => $query->whereHas('order', function ($query) {
                $query->where('country_id', request()->filter['country_id'] ?? null);
            })
        )
        ->paginate();
        $categories = Category::select('id', 'name')->get();
        $countries = Country::select('id', 'name')->get();
        $projects = Project::select('id', 'name')->get();
        return view('transactions.index', compact('transactions', 'categories', 'countries', 'projects'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        $countries = Country::select('id', 'name')->get();
        $projects = Project::select('id', 'name')->get();
        $tags = Tag::select('id', 'name')->get();
        return view('transactions.create', compact('categories', 'countries', 'projects', 'tags'));
    }

    public function store(TransactionRequest $request)
    {
        Transaction::create($request->validated());
        return redirect()->route('transactions.index')->with('success', __('Transaction created successfully.'));
    }

    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('transactions.show', compact('transaction'));
    }

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $categories = Category::select('id', 'name')->get();
        $countries = Country::select('id', 'name')->get();
        $projects = Project::select('id', 'name')->get();
        $tags = Tag::select('id', 'name')->get();
        return view('transactions.edit', compact('transaction', 'categories', 'countries', 'projects', 'tags'));
    }

    public function update(TransactionRequest $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->validated());
        return redirect()->route('transactions.index')->with('success', __('Transaction updated successfully.'));
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', __('Transaction deleted successfully.'));
    }
    public function deleteSelectRow(Request $request)
    {
        $selectedRows = $request->input('selectedRows');
        if ($selectedRows == null) {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(Transaction::class, $selectedRows);
        return back()->with('success', __('Transaction deleted successfully.'));

    }
    public function export()
    {
        $array = [
            __('ID'),
            __('Tag'),
            __('Category'),
            __('Project Name'),
            __('Project Code'),
            __('Continent'),
            __('Price'),
            __('Quantity'),
            __('Amount'),
            __('Comment'),
            __('Created At'),
        ];
        $data = Transaction::select(
            'transactions.id',
            'tags.name as tag',
            'categories.name as category',
            'projects.name as project_name',
            'project_code',
            'continent',
            'price',
            'quantity',
            'amount',
            'comment',
            'transactions.created_at'
        )
            ->leftJoin('projects', 'transactions.project_id', 'projects.id')
            ->leftJoin('tags', 'transactions.tag_id', 'tags.id')
            ->leftJoin('categories', 'transactions.category_id', 'categories.id')
            ->filter()->get();
        return Excel::download(new exportToExcel($data, $array), 'transactions.csv');
    }
}
