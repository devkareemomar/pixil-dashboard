<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use Maatwebsite\Excel\Facades\Excel;
use OwenIt\Auditing\Models\Audit;

class AuditController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:audit-read', ['only' => ['index']]);
    }

    public function index()
    {
        $audits = Audit::latest()->paginate(); // Change pagination settings as needed
        return view('audit-trail.index', compact('audits'));
    }

    public function show($id)
    {
        $audit = Audit::findOrFail($id);
        return view('audit-trail.show', compact('audit'));
    }
    public function export()
    {
        $array = [
            '#',
            __('User Type'),
            __('User ID'),
            __('User Name'),
            __('Event'),
            __('Auditable Type'),
            __('Auditable ID'),
            __('Old Values'),
            __('New Values'),
            __('URL'),
            __('IP Address'),
            __('User Agent'),
            __('Created At')
        ];
        $data = Audit::select('audits.id','user_type','users.id as user_id','users.name as user_name','event','auditable_type','auditable_id',
            'old_values','new_values','url','ip_address','user_agent','audits.created_at')
            ->leftJoin('users','audits.user_id','users.id')
            ->get();
        return Excel::download(new exportToExcel($data, $array), 'Audits.csv');
    }
}
