@extends('layout.app')

@section('title', __('Page Visits'))
@section('description', __('Page visit activity'))

@section('content')

    <div class="container-fluid" style="padding-bottom: 24px">
        <Br>
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4 class="text-capitalize">{{ __('Page Visits') }}</h4>
                <div class="m-1 mt-3">
                    <a class="btn btn-secondary mb-3"  style="display: inline-block" href="{{route('visits.export',request()->getQueryString())}}"> {{__('Export Data')}}</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                        <table class="table mb-20 table-borderless">
                    <thead>
                    <tr class="userDatatable-header">
                        <th>{{ __('Page Name') }}</th>
                        <th>{{ __('Type of Page') }}</th>
                        <th>{{ __('Count of Total Visits') }}</th>
                        <th>{{ __('Last Visit Date/Time') }}</th>
                        <th>{{ __('Last Visit User') }}</th>
                        <th>{{ __('Last Visitor IP') }}</th>
                        <th>{{ __('Country') }}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($pages as $page)
                        <tr>
                            <td>
							<span class="tooltip-container">
								<a href="{{route('visits.page', $page->id)}}">
									<i class="fas fa-plus-circle"></i>
								</a>
								{{ $page->page_name }}
								<span class="tooltip-text">{{ __('Page Visit Details') }}</span>
							</span>
                            </td>
                            <td>{{ $page->type }}</td>
                            <td>{{ $page->total_visits }}</td>
                            <td>{{ $page->last_visit_date }}</td>
                            <td>
							<span class="tooltip-container">
								<a @if($page->user) href="{{route('visits.user', $page->user->id)}}" @endif>
									<i class="fas fa-plus-circle"></i>
								</a>
								{{ $page->last_visit_name }}
								<span class="tooltip-text">{{ __('User Visit Details') }}</span>
							</span>
                            </td>
                            <td>
                            {{ $page->last_visitor_ip }}
                            <td>
                                {{$page->country}}
                                @if($page->country_code)
                                    <img src="https://flagsapi.com/{{$page->country_code}}/flat/64.png">
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    </div>


            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .tooltip-text {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            padding: 5px;
            border: 1px solid #ddd;
            z-index: 1;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tooltipContainers = document.querySelectorAll(".tooltip-container");

            tooltipContainers.forEach(container => {
                const icon = container.querySelector(".fa-plus-circle");
                const tooltip = container.querySelector(".tooltip-text");

                icon.addEventListener("mouseover", () => {
                    tooltip.style.display = "block";
                });

                icon.addEventListener("mouseout", () => {
                    tooltip.style.display = "none";
                });
            });
        });
    </script>
@endpush
