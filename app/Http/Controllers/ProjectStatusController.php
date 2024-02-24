<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Helpers\DeleteRow;
use App\Http\Requests\ProjectStatusRequest;
use App\Interface\ProjectStatusInterface;
use App\Models\ProjectStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProjectStatusController extends Controller
{

    private $status;

    public function __construct(ProjectStatusInterface $status)
    {
        $this->status = $status;

        $this->middleware('permission:project status-read|project status-create|project status-update|project status-delete', ['only' => ['index']]);
        $this->middleware('permission:project status-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:project status-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:project status-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $results = ProjectStatus::query()->filter()->paginate();
        return view('projectStatuses.index', compact('results'));
    }

    public function create()
    {
        return view('projectStatuses.create');

    }

    public function store(ProjectStatusRequest $request)
    {
        $data = $request->validated();
        $this->status->store($data);
        return redirect()->route('projectStatuses.index')->with('success', __('project status created successfully.'));
    }

    public function edit($status_id)
    {
        $result = $this->status->edit($status_id);
        return view('projectStatuses.edit', compact('result'));
    }

    public function update(ProjectStatusRequest $request, $status_id)
    {
        $data = $request->validated();
        $this->status->update($data, $status_id);
        return redirect()->route('projectStatuses.index')->with('success', __('project status updated successfully.'));
    }

    public function destroy($status_id)
    {
        $this->status->destroy($status_id);
        return back()->with('success', __('project status deleted successfully.'));
    }

    public function deleteSelectRow(Request $request)
    {
        $selectedRows=$request->input('selectedRows');
        if ($selectedRows==null)
        {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(ProjectStatus::class, $selectedRows);
        return back()->with('success', __('project status deleted successfully.'));

    }

    public function export()
    {
        $array = [
            __('ID'),
            __('Name'),
            __('Description'),
            __('Color'),
            __('Is New'),
            __('Is Active'),
            __('Is Completed'),
        ];
        $data = ProjectStatus::select('id', 'name', 'description', 'color',
            DB::raw('CASE WHEN project_statuses.is_new = 1 THEN "new" ELSE "not new" END AS is_new'),
            DB::raw('CASE WHEN project_statuses.is_active = 1 THEN "active" ELSE "not active" END AS is_active'),
            DB::raw('CASE WHEN project_statuses.is_completed = 1 THEN "Completed" ELSE "not completed" END AS is_completed'))
            ->filter()->get();

        return Excel::download(new exportToExcel($data, $array), 'ProjectStatus.csv');
    }
}
