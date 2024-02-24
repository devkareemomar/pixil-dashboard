@extends('layout.app')

@section('title', __('Audit log Details'))
@section('description', __('View audit log details'))

@section('content')
    <div class="container-fluid pb-30 pt-30"  >
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Audit log Details') }}</h4>
            </div>
            <div class="card-body">

        <div class="table-responsive">
                        <table class="table table-striped">
            <tbody>
            <tr>
                <th>{{ __('Event') }}</th>
                <td>{{ $audit->event }}</td>
            </tr>
            <tr>
                <th>{{ __('Auditable Type') }}</th>
                <td>{{ class_basename($audit->auditable_type) }}</td>
            </tr>
            <tr>
                <th>{{ __('Auditable ID') }}</th>
                <td>{{ $audit->auditable_id }}</td>
            </tr>
            <tr>
                <th>{{ __('Old Values') }}</th>
                <td>
                    @forelse ($audit->old_values as $key => $value)
                        {{ $key }}: {{ $value }}<br>
                    @empty
                        {{ __('No old values') }}
                    @endforelse
                </td>
            </tr>
            <tr>
                <th>{{ __('New Values') }}</th>
                <td>
                    @forelse ($audit->new_values as $key => $value)
                        {{ $key }}: {{ $value }}<br>
                    @empty
                        {{ __('No old values') }}
                    @endforelse
                </td>
            </tr>
            <tr>
                <th>{{ __('URL') }}</th>
                <td>{{ $audit->url }}</td>
            </tr>
            <tr>
                <th>{{ __('IP Address') }}</th>
                <td>{{ $audit->ip_address }}</td>
            </tr>
            <tr>
                <th>{{ __('User Agent') }}</th>
                <td>{{ $audit->user_agent }}</td>
            </tr>
            <tr>
                <th>{{ __('Tags') }}</th>
                <td>{{ $audit->tags }}</td>
            </tr>
            <tr>
                <th>{{ __('Timestamp') }}</th>
                <td>{{ $audit->created_at }}</td>
            </tr>
            </tbody>
        </table>
                    </div>
    </div>
@endsection
