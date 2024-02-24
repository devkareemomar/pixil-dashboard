<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Helpers\DeleteRow;
use App\Http\Requests\CareerRequest;
use App\Interface\CareerInterface;
use App\Models\Career;
use App\Models\JobCategory;
use App\Models\Nationality;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CareerController extends Controller
{

    private $career;

    public function __construct(CareerInterface $career)
    {
        $this->career = $career;

        $this->middleware('permission:career-read|career-create|career-update|career-delete', ['only' => ['index']]);
        $this->middleware('permission:career-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:career-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:career-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $results = Career::filter()->paginate();
        $jobs = JobCategory::all();
        $nationalities = Nationality::all();
        return view('careers.index', compact('results', 'jobs', 'nationalities'));
    }

    public function create()
    {
        return view('careers.create');

    }

    public function show($career_id)
    {
        $result = $this->career->show($career_id);
        return view('careers.show', compact('result'));
    }

    public function store(CareerRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('careers', 'public');
        }
        $this->career->store($data);
        return redirect()->route('careers.index')->with('success',  __('Career created successfully.'));
    }

    public function edit($career_id)
    {
        $result = $this->career->edit($career_id);
        return view('careers.edit', compact('result'));
    }

    public function update(CareerRequest $request, $career_id)
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('careers', 'public');

        }
        $this->career->update($data, $career_id);
        return redirect()->route('careers.index')->with('success',  __('Career updated successfully.'));
    }

    public function destroy($career_id)
    {
        $this->career->destroy($career_id);
        return back()->with('success',  __('Career deleted successfully.'));
    }
    public function deleteSelectRow(Request $request)
    {
        $selectedRows=$request->input('selectedRows');
        if ($selectedRows==null)
        {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(Career::class,$selectedRows);
        return back()->with('success',  __('Career deleted successfully.'));

    }
    public function export()
    {

        $header = [
            '#',
            __('Name'),
            __('Email'),
            __('Phone'),
            __('Job Categories'),
            __('Nationality')
        ];
        $data = Career::select('careers.id','careers.name','email','phone','job_categories.name as job_categories','nationalities.name as nationality')->LeftJoin('job_categories','job_categories.id','careers.job_category_id')->LeftJoin('nationalities','nationalities.id','careers.nationality_id')->filter()->get();
        return Excel::download(new exportToExcel($data, $header), 'Careers.csv');
    }
}
