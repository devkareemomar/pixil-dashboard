@extends('layout.app')

@section('title', __('Pages'))
@section('description', __('Manage pages'))

@section('content')
    <div class="container-fluid" style="padding-bottom: 24px">
        <div class="container-fluid" style="padding-bottom: 24px">
            <Br>
            <div class="card mb-80">
                <div class="card-header color-dark fw-500">
                    <h4 class="text-capitalize">{{ __('Pages') }} ({{ $pages->links()->paginator->total() }})</h4>
                    <div class="m-1 mt-3">
                        <a href="{{ route('pages.create') }}" class="btn btn-primary mb-3">{{ __('Create page') }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <x-filter :filter_attributes="[
                        'project_id' => $projects,
                        'name' => 'text',
                        'title' => 'text',
                        'description' => 'text'
                    ]"/>
                    <form action="{{ route('pages.deleteSelectRow') }}" enctype="multipart/form-data" method="post">
                        <br>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                data-toggle="tooltip" data-placement="top"
                                onclick="return confirm('{{ __('Are you sure you want to delete the selected items?') }}')">
                            {{ __('Delete Selected Rows') }}
                        </button>
                        <div class="table-responsive">
                            <table class="table mb-20 table-borderless">
                                <thead>
                                <tr class="userDatatable-header">
                                    <th><input type="checkbox" id="select-all-checkbox"></th>
                                    <th>#</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($pages as $key => $page)
                                    <tr>
                                        <td><input type="checkbox" name="selectedRows[]" value="{{ $page->id }}"
                                                   class="row-checkbox"></td>
                                        <td>{{ $loop->iteration + $pages->links()->paginator->firstItem() - 1 }}</td>
                                        <td>{{ $page->name }}</td>
                                        <td>{{ $page->title }}</td>
                                        <td>{{ $page->description }}</td>
                                        <td>
                                            <x-action-buttons route="pages" :model="$page" :show="false"/>
                                        </td>
                                    </tr>
                                @endforeach
                                @if(count($pages) <= 0)
                                    <tr>
                                        <td style="text-align: center" colspan="5">{{ __('No Data Yet') }}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $pages->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection

