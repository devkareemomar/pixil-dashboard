@extends('layout.app')

@section('title', __('Project Details'))
@section('description', __('View project details'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-breadcrumb">
                    <div class="breadcrumb-main add-contact justify-content-sm-between">
                        <div class="d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                            <div class="d-flex align-items-center add-contact__title justify-content-center me-sm-25">
                                <h4 class="text-capitalize fw-500 breadcrumb-title">{{ __('Project Details') }}</h4>
                                <span class="sub-title ms-sm-25 ps-sm-25">{{ __('View project details') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-30">
                <div class="card">
                    <div class="card-header color-dark fw-500">
                        {{ __('Project Details') }}
                    </div>
                    <div class="card-body">
                        <div class="userDatatable global-shadow border-light-0 w-100">
                            <div class="table-responsive">
                                <div class="table-responsive">
                        <table class="table mb-0 table-borderless">
                                    <tbody>
                                    <tr>
                                        <th>{{ __('ID') }}</th>
                                        <td>{{ $project->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <td>{{ $project->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Slug') }}</th>
                                        <td>{{ $project->slug }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('SKU') }}</th>
                                        <td>{{ $project->sku }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Creator ID') }}</th>
                                        <td>{{ $project->creator->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Total Earned') }}</th>
                                        <td>{{ $project->total_earned }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Total Wanted') }}</th>
                                        <td>{{ $project->total_wanted }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Status') }}</th>
                                        <td>{{ $project->status?->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Description') }}</th>
                                        <td>{{ $project->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Short Description') }}</th>
                                        <td>{{ $project->short_description }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Featured') }}</th>
                                        <td>{{ $project->featured }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Thumbnail') }}</th>
                                        <td><img src="{{ asset('storage/' . $project->thumbnail) }}"
                                                 alt="{{ $project->name }}" width="32"></td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Start Date') }}</th>
                                        <td>{{ $project->start_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('End Date') }}</th>
                                        <td>{{ $project->end_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Visibility') }}</th>
                                        <td>{{ $project->visibility }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Accept Donation') }}</th>
                                        <td>{{ $project->accept_donation }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Show in Home Page') }}</th>
                                        <td>{{ $project->show_in_home_page }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Show in Shop') }}</th>
                                        <td>{{ $project->show_in_shop }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Is Gift') }}</th>
                                        <td>{{ $project->is_gift }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Category ID') }}</th>
                                        <td>{{ $project->category_id }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Sub Category ID') }}</th>
                                        <td>{{ $project->sub_category_id }}</td>
                                    </tr>
                                    @include('projects.partials._related-tables')
                                    </tbody>
                                </table>
                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
