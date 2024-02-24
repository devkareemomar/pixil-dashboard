@extends('layout.app')

@section('title', __('Careers'))
@section('description', __('Manage Careers'))

@section('content')
    <div class="container-fluid" style="padding-bottom: 24px">
        <Br>
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4 class="text-capitalize">{{ __('Careers') }} ({{ $results->links()->paginator->total() }})</h4>
                <div class="m-1 mt-3">
                    <a class="btn btn-secondary mb-3" style="display: inline-block"
                       href="{{route('careers.export',request()->getQueryString())}}"> {{__('Export Data')}}</a>

                    <a href="{{ route('careers.create') }}" style="display: inline-block"
                       class="btn btn-primary mb-3">{{ __('Create Career') }}</a>
                </div>
            </div>

            <x-filter :filter_attributes="[
                                'name' => 'text',
                                'email' => 'text',
                                'phone' => 'text',
                                'job_category_id' => $jobs,
                                'nationality_id' => $nationalities
                                ]"/>
            <div class="form-check form-switch m-2">
                <input class="form-check-input" type="checkbox" role="switch" value="1" id="show"/>
                <label class="form-check-label">{{ __('Advanced Options') }}</label>
            </div>

            <form action="{{route('careers.deleteSelectRow')}}" enctype="multipart/form-data" method="post">
                @csrf
                @method('DELETE')
                <div class="menu m-2" style="display: none;">
                    <button type="submit" class="btn btn-danger" title="{{__('Delete Selected Rows')}}"
                            data-toggle="tooltip" data-placement="top"
                            onclick="return confirm('{{ __('Are you sure you want to delete this item?') }}')">
                        <i class="fa fa-trash fa-sm m-0 p-2"></i>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table mb-20 table-borderless">
                        <thead>
                        <tr class="userDatatable-header">
                            <th><input type="checkbox" id="select-all-checkbox"></th>
                            <th>#</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Job title') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Phone') }}</th>
                            <th>{{ __('Nationality') }}</th>
                            <th>{{ __('File') }}</th>
                            <th>{{ __('Actions') }}</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($results as $key=>$result)
                            <tr>
                                <td><input type="checkbox" name="selectedRows[]" value="{{ $result->id }}"
                                           class="row-checkbox"></td>
                                <td>{{ $loop->iteration + $results->links()->paginator->firstItem() - 1}}</td>
                                <td>{{ $result->name }}</td>
                                <td>{{ $result->job_category->name }}</td>
                                <td>{{ $result->email }}</td>
                                <td>{{$result->phone}}</td>
                                <td>{{$result->nationality->name}}</td>
                                <td><a download href="{{asset('storage/'.$result->file)}}"><img width="50px"
                                                                                                src="{{asset('assets/img/download.png')}}"></a>
                                </td>
                                <td>
                                    <x-action-buttons :model="$result" route="careers" :show="false"/>
                                </td>
                            </tr>
                        @endforeach
                        @if(count($results)<=0)
                            <tr>
                                <td style="text-align: center" colspan="8"> {{__('No Data Yet')}}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
        <div class="d-flex justify-content-center">
            {{ $results->links()}}
        </div>
    </div>
    </div>
@endsection
