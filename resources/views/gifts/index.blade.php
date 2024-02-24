@extends('layout.app')

@section('title', __('Gifts'))
@section('description', __('Manage gifts'))

@section('content')
    <div class="container-fluid" style="padding-bottom: 24px">
        <Br>
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4 class="text-capitalize">{{ __('Gifts') }} ({{ $gifts->links()->paginator->total() }})</h4>
                <div class="m-1 mt-3">
                    {{--                    <a class="btn btn-secondary mb-3"  style="display: inline-block" href="{{route('gifts.export',request()->getQueryString())}}"> {{__('Export Data')}}</a>--}}
                </div>
            </div>
            <div class="card-body">
                {{--                $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();--}}
                {{--                $table->foreignId('project_id')->constrained()->cascadeOnDelete();--}}
                {{--                $table->string('sender_name')->nullable();--}}
                {{--                $table->string('sender_email')->nullable();--}}
                {{--                $table->string('recipient_name')->nullable();--}}
                {{--                $table->string('recipient_email')->nullable();--}}
                {{--                $table->double('price')->default(0);--}}
                <x-filter
                    :filter_attributes="['project_id' => $projects, 'sender_name' => 'text', 'sender_email' => 'text', 'recipient_name' => 'text', 'recipient_email' => 'text']"/>
                <div class="table-responsive">
                    <table class="table mb-20 table-borderless">
                        <thead>
                        <tr class="userDatatable-header">
                            <th>#</th>
                            <th>{{ __('Sender Name') }}</th>
                            <th>{{ __('Sender Email') }}</th>
                            <th>{{ __('Recipient Name') }}</th>
                            <th>{{ __('Recipient Email') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Project') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($gifts as $gift)
                            <tr>
                                <td>{{ $loop->iteration  + $gifts->links()->paginator->firstItem() - 1}}</td>
                                <td>{{ $gift->sender_name }}</td>
                                <td>{{ $gift->sender_email }}</td>
                                <td>{{ $gift->recipient_name }}</td>
                                <td>{{ $gift->recipient_email }}</td>
                                <td>{{ $gift->price }}</td>
                                <td>{{ $gift->project->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td style="text-align: center" colspan="8"> {{__('No Data Yet')}}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $gifts->links() }}
            </div>
        </div>
    </div>
@endsection
