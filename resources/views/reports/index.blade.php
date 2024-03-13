@extends('layout.app')

@section('title', __('Reports'))
@section('description', __('Manage reports'))

@section('content')
    <div class="container-fluid" style="padding-bottom: 24px">
        <Br>
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4 class="text-capitalize">{{ __('Reports') }}({{ $reports->links()->paginator->total() }})</h4>
                <div class="m-1 mt-3">
                    <a class="btn btn-secondary mb-3" style="display: inline-block"
                        href="{{ route('reports.export', request()->getQueryString()) }}"> {{ __('Export Data') }}</a>
                </div>
            </div>
            <div class="card-body">
                <x-filter :filter_attributes="[
                    'status' => ['pending' => __('Pending'), 'completed' => __('Completed'),'failed' => __('Failed')],
                    'project_id' => $projects,
                    'from_date' => 'date',
                    'to_date' => 'date',
                    'user_id' => $users,
                    'campaign_id' => $campaigns,
                ]" />

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="total_page">{{ __('Total Page') }}</label>
                            <input type="text" disabled class="form-control" id="total_page"
                                value="{{ $reports->sum('price') }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="to_data">{{ __('Total') }}</label>
                            <input type="text" disabled class="form-control" id="to_data" name="to_data"
                                value="{{ $total_price }}">
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table mb-20 table-borderless">
                        <thead>
                            <tr class="userDatatable-header">
                                <th>#</th>
                                <th>{{ __('Category') }}</th>
                                {{-- <th>{{ __('Division') }}</th> --}}
                                <th>{{ __('Project') }}</th>
                                <th>{{ __('Project Code') }}</th>
                                <th>{{ __('Transaction Number') }}</th>
                                <th>{{ __('Reference Number') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reports as $key=>$report)

                                <tr>
                                    <td>{{ $loop->iteration + $reports->links()->paginator->firstItem() - 1 }}</td>
                                    <td>{{ $report->project?->category?->name }}</td>
                                    {{-- <td>{{ $report->project?->division?->name }}</td> --}}
                                    <td>{{ $report->project?->name }}</td>
                                    <td>{{ $report->project?->id }}</td>
                                    <td>{{ $report->order?->payment?->metadata['id'] ?? ''}}
                                    </td>
                                    <td>{{ $report->order?->payment?->charge_id }}</td>
                                    <td>{{ $report->order?->payment_type }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td style="text-align: center" colspan="10"> {{ __('No Data Yet') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $reports->links() }}
            </div>
        </div>
    </div>
@endsection
