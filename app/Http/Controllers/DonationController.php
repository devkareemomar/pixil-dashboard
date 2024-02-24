<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\OrderProject;
use App\Models\Project;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class DonationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:donation-read', ['only' => ['index']]);
    }

    public function index()
    {
        $filters = request()->filter;

        $donations = OrderProject::with('project', 'order.user', 'order')
            ->when(isset($filters['project_id']), function ($query) use ($filters) {
                return $query->where('project_id', $filters['project_id']);
            })
            ->when(isset($filters['user_id']), function ($query) use ($filters) {
                return $query->whereHas('order', function ($query) use ($filters) {
                    $query->where('user_id', $filters['user_id']);
                });
            })
            ->when(isset($filters['phone']), function ($query) use ($filters) {
                return $query->whereHas('order', function ($query) use ($filters) {
                    $query->where('phone', $filters['phone']);
                });
            })
            ->whereHas('order', function ($query) {
                $query->where('status', 'completed');
            })
            ->paginate();

        $projects = Project::all();
        $users = User::all();

        return view('donations.index', compact('donations', 'projects', 'users'));
    }

    public function export()
    {
        $array = [
            __('ID'),
            __('Project Name'),
            __('Amount'),
            __('User Name'),
            __('Donor Name'),
            __('Donor Phone'),
            __('Tag'),
            __('Payment Method'),
        ];
        $data = Donation::select(
            'donations.id',
            'projects.name as project_name',
            'amount',
            'users.name as user_name',
            'donor_name',
            'donor_phone',
            'tags.name as tag',
            'payment_method',
        )
            ->leftJoin('projects', 'donations.project_id', 'projects.id')
            ->leftJoin('tags', 'donations.tag_id', 'tags.id')
            ->leftJoin('users', 'donations.user_id', 'users.id')
            ->filter()->get();
        return Excel::download(new exportToExcel($data, $array), 'Donation.csv');
    }

    // private function filterCampaign()
    // {
    //     $campaign = request()->filter['campaign_id'] ?? null;
    //     if ($campaign) {
    //         $campaign = Campaign::find($campaign);
    //         return $campaign->projectOrders();
    //     }
    //     return OrderProject::query();
    // }
}
