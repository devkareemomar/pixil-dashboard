<?php

namespace App\Http\Controllers;

use App\Models\OrderProject;
use App\Models\Project;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $total_projects = Project::all()->count();
        $last_month_projects = Project::whereMonth('created_at', now()->subMonth()->month)->count();
        $this_month_projects = Project::whereMonth('created_at', now()->month)->count();
        if ($last_month_projects == 0) {
            $projects_difference = 100;
        } else {
            $projects_difference = ($this_month_projects - $last_month_projects) / $last_month_projects * 100;
        }

        $total_users = User::all()->count();
        $last_month_users = User::whereMonth('created_at', now()->subMonth()->month)->count();
        $this_month_users = User::whereMonth('created_at', now()->month)->count();
        if ($last_month_users == 0) {
            $users_difference = 100;
        } else {
            $users_difference = ($this_month_users - $last_month_users) / $last_month_users * 100;
        }

        $total_visits = Visit::count();
        $last_month_visits = Visit::whereMonth('created_at', now()->subMonth()->month)->count();
        $this_month_visits = Visit::whereMonth('created_at', now()->month)->count();
        if ($last_month_visits == 0) {
            $visits_difference = 100;
        } else {
            $visits_difference = ($this_month_visits - $last_month_visits) / $last_month_visits * 100;
        }


        $total_earned = Project::sum('total_earned');
        $last_month_earned = Project::whereMonth('created_at', now()->subMonth()->month)->sum('total_earned');
        $this_month_earned = Project::whereMonth('created_at', now()->month)->sum('total_earned');
        if ($last_month_earned == 0) {
            $earned_difference = 100;
        } else {
            $earned_difference = ($this_month_earned - $last_month_earned) / $last_month_earned * 100;
        }

        $users = User::orderBy('created_at', 'Desc')->where('role_id', 2)->get()->take('10');

        $finished_projects = Project::where('total_wanted', '<=', DB::raw('total_earned'))->count();
        $active_projects = Project::where('total_wanted', '>', DB::raw('total_earned'))->count();

        $january = OrderProject::whereMonth('created_at', '01')->whereYear('created_at', now()->year)->sum('price');
        $february = OrderProject::whereMonth('created_at', '02')->whereYear('created_at', now()->year)->sum('price');
        $march = OrderProject::whereMonth('created_at', '03')->whereYear('created_at', now()->year)->sum('price');
        $april = OrderProject::whereMonth('created_at', '04')->whereYear('created_at', now()->year)->sum('price');
        $may = OrderProject::whereMonth('created_at', '05')->whereYear('created_at', now()->year)->sum('price');
        $june = OrderProject::whereMonth('created_at', '06')->whereYear('created_at', now()->year)->sum('price');
        $july = OrderProject::whereMonth('created_at', '07')->whereYear('created_at', now()->year)->sum('price');
        $august = OrderProject::whereMonth('created_at', '08')->whereYear('created_at', now()->year)->sum('price');
        $september = OrderProject::whereMonth('created_at', '09')->whereYear('created_at', now()->year)->sum('price');
        $october = OrderProject::whereMonth('created_at', '10')->whereYear('created_at', now()->year)->sum('price');
        $november = OrderProject::whereMonth('created_at', '11')->whereYear('created_at', now()->year)->sum('price');
        $december = OrderProject::whereMonth('created_at', '12')->whereYear('created_at', now()->year)->sum('price');

        return view('index', compact(
            'users',
            'total_projects',
            'total_users',
            'total_visits',
            'total_earned',
            'finished_projects',
            'active_projects',
            'january',
            'february',
            'march',
            'april',
            'may',
            'june',
            'july',
            'august',
            'september',
            'october',
            'november',
            'december',
            'projects_difference',
            'users_difference',
            'visits_difference',
            'earned_difference'
        ));
    }
}
