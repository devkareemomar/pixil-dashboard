<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Models\User;
use App\Models\Visit;
use Maatwebsite\Excel\Facades\Excel;

class VisitsController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:visit-read', ['only' => ['index', 'page', 'user']]);
    }

    public function index()
    {
        $pages = Visit::getPagesWithVisitDetails();

        return view('visits.index', compact('pages'));
    }

    public function page($visit_id)
    {
        $visits = Visit::getPageWithVisitDetails($visit_id);
        $visit = Visit::find($visit_id);
        $page = $visit->visitable;

        return view('visits.page', compact('visits', 'page'));
    }

    public function user($userId)
    {
        $activities = Visit::getUserActivities($userId);
        $user = User::find($userId);

        return view('visits.user', compact('user','activities'));
    }
    public function export()
    {
        $array = [
            __('ID'),
            __('Visitable Type'),
            __('User ID'),
            __('User Name'),
            __('IP'),
            __('Country'),
            __('Country Code'),
        ];
        $data = Visit::select('visitables.id','visitable_type','users.id as user_id','users.name as user_name','ip','country','country_code')
            ->leftJoin('users','visitables.user_id','users.id')
            ->get();
        return Excel::download(new exportToExcel($data, $array), 'Links.csv');
    }
}
