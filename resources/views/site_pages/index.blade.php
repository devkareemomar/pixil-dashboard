@extends('layout.app')
@section('title', __('Site Pages'))
@section('description', __('Manage Site Pages'))

@section('content')
    <div class="container-fluid" style="padding-bottom: 24px">
        <Br>
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4 class="text-capitalize">{{ __('Site Pages') }} ({{ $pages->links()->paginator->total() }})</h4>
                <div class="m-1 mt-3">
                    <a href="{{ route('site-pages.create') }}" style="display: inline-block"
                       class="btn btn-primary mb-3">{{ __('Create Pages') }}</a>
                </div>
            </div>
            <div class="card-body">
                <x-filter :filter_attributes="[
                                'title' => 'text',
                                'status' => ['published' => __('Published'), 'unpublished' => __('Unpublished')],
                            ]"/>
                <div class="table-responsive">
                    <table class="table mb-20 table-borderless">
                        <thead>
                        <tr class="userDatatable-header">
                            <th>#</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('User') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Key') }}</th>
                            <th>{{ __('Lang') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($pages as $key => $page)
                            <tr>
                                <td>{{ $loop->iteration + $pages->links()->paginator->firstItem() - 1 }}</td>
                                <td>{{ $page->title }}</td>
                                <td>{{ $page->user?->name }}</td>
                                <td>
                                    @if ($page->status == 'published')
                                        <span class="badge badge-success">
								            {{ __('Published') }}
							            </span
                                    @elseif($page->status == 'unpublished')
                                        <span class="badge badge-dark">
                                            {{ __('Unpublished') }}
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            {{ $page->status }}
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $page->key }}</td>
                                <td>{{ $page->lang }}</td>
                                <td>
                                    <ul class="list-inline m-0 d-inline-flex">
                                        @can("site pages-update")
                                            <li class="list-inline-item">
                                                <a href="{{ route("site-pages" . '.activate', $page->id) }}"
                                                   class="btn btn-info btn-square p-0 rounded-circle"
                                                   data-toggle="tooltip" data-placement="top"
                                                   title="{{ __('Change Status') }}">
                                                    <div class="d-flex align-items-center justify-content-center p-1">
                                                        @if ($page->status == 'published')
                                                            <i class="fa fa-toggle-off fa-sm m-0 p-0"></i>
                                                        @elseif($page->status == 'unpublished')
                                                            <i class="fa fa-toggle-on fa-sm m-0 p-0"></i>
                                                        @endif
                                                    </div>
                                                </a>
                                            </li>
                                        @endcan
                                        @can("site pages-update")
                                            <li class="list-inline-item">
                                                <a href="{{ route("page-builder" . '.show', $page->id) }}"
                                                   class="btn btn-success btn-square p-0 rounded-circle"
                                                   data-toggle="tooltip" data-placement="top"
                                                   title="{{ __('Page Builder') }}">
                                                    <div class="d-flex align-items-center justify-content-center p-1">
                                                        <i class="fa fa-edit fa-sm m-0 p-0"></i>
                                                    </div>
                                                </a>
                                            </li>
                                        @endcan
                                        <li class="list-inline-item">
                                            <a class="btn btn-warning btn-square p-0 rounded-circle"
                                               data-toggle="tooltip"
                                               data-placement="top" title="{{ __('Duplicate') }}"
                                               href="{{ route('site-pages.duplicate',$page->id) }}"
                                               data-confirm="{{ __('Are you sure you want to duplicate this item?') }}"
                                            >
                                                <div class="d-flex align-items-center justify-content-center p-1">
                                                    <i class="fa fa-copy fa-sm m-0 p-0"></i>
                                                </div>
                                            </a>
                                        </li>
                                        @can("site pages-delete")
                                            <li class="list-inline-item">
                                                <a class="btn btn-danger btn-square p-0 rounded-circle"
                                                   data-toggle="tooltip"
                                                   data-placement="top" title="{{ __('Delete') }}"
                                                   href="{{ route('site-pages.deleteSelectRow',['selectedRows' => [$page->id]]) }}"
                                                   data-method="delete" data-token="{{csrf_token()}}"
                                                   data-confirm="{{ __('Are you sure you want to delete this item?') }}"
                                                >
                                                    <div class="d-flex align-items-center justify-content-center p-1">
                                                        <i class="fa fa-trash fa-sm m-0 p-0"></i>
                                                    </div>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $pages->links() }}
            </div>
        </div>
    </div>
@endsection
