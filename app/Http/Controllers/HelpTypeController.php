<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Helpers\DeleteRow;
use App\Http\Requests\HelpTypeRequest;
use App\Interface\HelpTypeInterface;
use App\Models\HelpType;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HelpTypeController extends Controller
{

    private $help;

    public function __construct(HelpTypeInterface $help)
    {
        $this->help = $help;

        $this->middleware('permission:help type-read|help type-create|help type-update|help type-delete', ['only' => ['index']]);
        $this->middleware('permission:help type-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:help type-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:help type-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $results = HelpType::filter()->paginate();
        return view('help_types.index', compact('results'));
    }

    public function create()
    {
        return view('help_types.create');

    }

    public function store(HelpTypeRequest $request)
    {
        $data = $request->validated();
        $this->help->store($data);
        return redirect()->route('help_types.index')->with('success',  __('help type created successfully.'));
    }

    public function edit($help_id)
    {
        $result = $this->help->edit($help_id);
        return view('help_types.edit', compact('result'));
    }

    public function update(HelpTypeRequest $request, $help_id)
    {
        $data = $request->validated();
        $this->help->update($data, $help_id);
        return redirect()->route('help_types.index')->with('success',  __('help type updated successfully.'));
    }

    public function destroy($help_id)
    {
        $this->help->destroy($help_id);
        return back()->with('success',  __('help type deleted successfully.'));
    }
    public function deleteSelectRow(Request $request)
    {
        $selectedRows=$request->input('selectedRows');
        if ($selectedRows==null)
        {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(HelpType::class,$selectedRows);
        return back()->with('success',  __('help type deleted successfully.'));

    }
    public function export()
    {
        $array = [
            __('ID'),__('Name')
        ];
        $data = HelpType::select('id','name')
            ->filter()->get();
        return Excel::download(new exportToExcel($data, $array), 'help-type.csv');
    }

}
