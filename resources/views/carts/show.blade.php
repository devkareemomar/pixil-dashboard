@extends('layout.app')

@section('title', __('Cart Details'))
@section('description', __('View details of a cart'))

@section('content')
    <div class="container-fluid" style="padding-bottom: 24px">
        <Br>
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4 class="text-capitalize">{{ __('Cart Details') }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                        <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th>{{ __('User') }}</th>
                        <td>{{ $cart->user?->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Session ID') }}</th>
                        <td>{{ $cart->session_id }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Total Amount') }}</th>
                        <td>{{ $cart->total_amount }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Client Notes') }}</th>
                        <td>{{ $cart->client_notes }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Admin Notes') }}</th>
                        <td>{{ $cart->admin_notes }}</td>
                    </tr>
                    </tbody>
                </table>
                    </div>

                <hr style="margin: 5px">
                <div class="card-header color-dark fw-500">
                    <h4 class="text-capitalize">{{ __('Projects') }}</h4>
                </div>
                <div class="table-responsive">
                        <table class="table mb-20 table-borderless">
                    <thead>
                    <tr class="userDatatable-header">
                        <th>#</th>
                        <th>{{ __('Project') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Gifted To Email') }}</th>
                        <th>{{ __('Gifted To Phone') }}</th>
                        <th>{{ __('Gifted To Name') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart->projects as $project)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->pivot->amount }}</td>
                            <td>{{ $project->pivot->gifted_to_email }}</td>
                            <td>{{ $project->pivot->gifted_to_phone }}</td>
                            <td>{{ $project->pivot->gifted_to_name }}</td>
                        </tr>
                    @endforeach
                    @if(count($cart->projects)<=0)
                        <tr>
                            <td style="text-align: center" colspan="4"> {{__('No Data Yet')}}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                    </div>
            </div>
        </div>
    </div>
@endsection
