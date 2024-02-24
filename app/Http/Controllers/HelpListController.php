<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Helpers\DeleteRow;
use App\Http\Requests\HelpListRequest;
use App\Interface\HelpListInterface;
use App\Models\HelpList;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class HelpListController extends Controller
{

    private $help;

    public function __construct(HelpListInterface $help)
    {
        $this->help = $help;

        $this->middleware('permission:help list-read|help list-create|help list-update|help list-delete', ['only' => ['index']]);
        $this->middleware('permission:help list-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:help list-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:help list-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $results = HelpList::filter()->paginate();
        return view('helps.index', compact('results'));
    }

    public function create()
    {
        return view('helps.create');

    }

    public function show($help_id)
    {
        $result = $this->help->show($help_id);
        return view('helps.show', compact('result'));
    }

    public function store(HelpListRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('helps', 'public');
        }
        $this->help->store($data);
        return redirect()->route('helps.index')->with('success',  __('help created successfully.'));
    }

    public function edit($help_id)
    {
        $result = $this->help->edit($help_id);
        return view('helps.edit', compact('result'));
    }

    public function update(HelpListRequest $request, $help_id)
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('helps', 'public');

        }
        $this->help->update($data, $help_id);
        return redirect()->route('helps.index')->with('success',  __('help updated successfully.'));
    }

    public function destroy($help_id)
    {
        $this->help->destroy($help_id);
        return back()->with('success',  __('help deleted successfully.'));
    }

    public function deleteSelectRow(Request $request)
    {
        $selectedRows=$request->input('selectedRows');
        if ($selectedRows==null)
        {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(HelpList::class,$selectedRows);
        return back()->with('success',  __('help deleted successfully.'));

    }

    public function export()
    {
        $array = [
            __('Nationality'),
            __('Help Type'),
            __('Service Status'),
            __('Gender'),
            __('Marital Status'),
            __('Name'),
            __('Civil ID'),
            __('Family Members'),
            __('Job'),
            __('Salary'),
            __('Address'),
            __('Other Information'),
            __('Phone'),
            __('Old Help Document'),
            __('Reference No'),
            __('Created At'),
        ];
        $data = HelpList::select( 'nationalities.name as nationality','help_types.name as help_type','service_status','gender','marital_status','help_lists.name','civil_id',
            'family_members','job','salary','address','other_information','phone','old_help_document',
            'reference_no','help_lists.created_at')
            ->leftJoin('nationalities','help_lists.nationality_id','nationalities.id')
            ->leftJoin('help_types','help_lists.help_type_id','help_types.id')
            ->filter()->get();
        return Excel::download(new exportToExcel($data, $array), 'help-list.csv');
    }


}
