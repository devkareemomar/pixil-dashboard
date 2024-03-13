<?php

namespace App\Http\Controllers;

use App\Exports\exportToExcel;
use App\Models\Campaign;
use App\Models\Link;
use App\Models\Order;
use App\Models\OrderProject;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        $reports = OrderProject::with('project.campaigns', 'order')
            ->filter()
            ->when(
                request('filter') && request('filter')['from_date'],
                fn($query) => $query->where('created_at', '>=', date('Y-m-d', strtotime(request('filter')['from_date'])))
            )
            ->when(
                request('filter') && request('filter')['to_date'],
                fn($query) => $query->where('created_at', '<=', date('Y-m-d', strtotime(request('filter')['to_date'])))
            )
            ->when(
                request('filter') && request('filter')['user_id'],
                fn($query) => $query->whereHas('order', function ($query) {
                    $query->where('user_id', request()->filter['user_id'] ?? null);
                })
            )
            ->when(
                request('filter') && request('filter')['status'],
                fn($query) => $query->whereHas('order', function ($query) {
                    $query->where('status', request()->filter['status'] ?? null);
                })
            )
            ->when(
                request('filter') && request('filter')['campaign_id'],
                fn($query) => $query->whereHas('project', function ($query) {
                    $query->whereHas('campaigns', function ($query) {
                        $query->where('campaign_id', request()->filter['campaign_id'] ?? null);
                    });
                })
            )
            ->paginate();
        $projects = Project::all();
        $users = User::all();
        $campaigns = Campaign::pluck('title')->toArray();
        $total_price = OrderProject::sum('price');
        return view('reports.index', compact('reports', 'projects', 'users', 'campaigns','total_price'));
    }

    public function socialMediaReport()
    {
        $reports = Link::filter()
            ->when(
                request('filter') && request('filter')['from_date'],
                fn($query) => $query->where('created_at', '>=', date('Y-m-d', strtotime(request('filter')['from_date'])))
            )
            ->when(
                request('filter') && request('filter')['to_date'],
                fn($query) => $query->where('created_at', '<=', date('Y-m-d', strtotime(request('filter')['to_date'])))
            )
            ->paginate();
        $projects = Project::all();
        $total_amount = Link::sum('amount');
        return view('reports.social-media', compact('reports', 'projects', 'total_amount'));
    }

    public function aliasLinksReport()
    {
        $reports = Link::filter()
            ->when(
                request('filter') && request('filter')['from_date'],
                fn($query) => $query->where('created_at', '>=', date('Y-m-d', strtotime(request('filter')['from_date'])))
            )
            ->when(
                request('filter') && request('filter')['to_date'],
                fn($query) => $query->where('created_at', '<=', date('Y-m-d', strtotime(request('filter')['to_date'])))
            )
            ->paginate();
        $projects = Project::all();
        $total_amount = Link::sum('amount');
        return view('reports.alias-links', compact('reports', 'projects', 'total_amount'));
    }

    public function export()
    {
        $array = [
            __('Category'),
            __('Division'),
            __('Project'),
            __('Project Code'),
            __('Transaction Number'),
            __('Reference Number'),
            __('Delegate'),
            __('Payment Method'),
        ];
        $data = OrderProject::with('project', 'order', 'project.category', 'project.division')
            ->filter()->get();

        $data = $data->map(function ($item) {
            return [
                'category' => $item->project?->category?->name,
                'division' => $item->project?->division?->name,
                'project' => $item->project?->name,
                'project_code' => $item->project?->id,
                'transaction_number' => array_key_exists('focusTransaction', $item->order?->payment?->metadata ?? []) ?
                    $item->order?->payment?->metadata['focusTransaction']['TransactionId'] : '',
                'reference_number' => array_key_exists('focusTransaction', $item->order?->payment?->metadata ?? []) ?
                    $item->order?->payment?->metadata['focusTransaction']['ReferenceId'] : '',
                'delegate' => '',
                'payment_method' => $item->order?->payment?->payment_method ?? array_key_exists('focusTransaction', $item->order?->payment?->metadata ?? []) ?
                    $item->order?->payment?->metadata['focusTransaction']['PaymentGateway'] : '',
            ];
        });



        return Excel::download(new exportToExcel($data, $array), 'Carts.csv');
    }

    public function exportSocialMedia()
    {
        $array = [
            '#',
            __('Project'),
            __('Url'),
            __('Platform'),
            __('Amount')
        ];
        $data = Link::with('project')->select('id', 'url', 'platform', 'amount')
            ->filter()->get();

        $data = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'project' => $item->project?->name,
                'platform' => $item->platform,
                'amount' => $item->amount,
            ];
        });

        return Excel::download(new exportToExcel($data, $array), 'Carts.csv');
    }

    public function exportAliasLinks()
    {
        $array = [
            '#',
            __('Code'),
            __('export'),
            __('Amount'),
            __('Project Id'),
            __('Project')
        ];
        $data = Link::with('project')->select('id', 'code', 'platform', 'amount', 'project_id')
            ->filter()->get();

        $data = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'code' => $item->code,
                'platform' => $item->platform,
                'amount' => $item->amount,
                'project_id' => $item->project_id,
                'project' => $item->project?->name,
            ];
        });
        return Excel::download(new exportToExcel($data, $array), 'Carts.csv');
    }
}
