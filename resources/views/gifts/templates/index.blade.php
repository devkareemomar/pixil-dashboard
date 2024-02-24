@extends('layout.app')

@section('title', __('templates'))
@section('description', __('Manage templates'))

@section('content')
    <div class="container-fluid" style="padding-bottom: 24px">
        <Br>
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4 class="text-capitalize">{{ __('templates') }} ({{ $templates->links()->paginator->total() }})</h4>
                <div class="m-1 mt-3">

                    <a href="{{ route('gifts.templates.create') }}" style="display: inline-block"
                        class="btn btn-primary mb-3">{{ __('Create Template') }}</a>
                </div>
            </div>
            <div class="card-body">

                <a id="show" class="m-1 hover-me-smooth text-dark" style="cursor: pointer;">
                    <i class="fa fa-caret-down"></i>
                    <label class="form-check-label">{{ __('Advanced Options') }}</label>
                </a>

                <form action="{{ route('gifts.templates.deleteSelectRow') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="menu m-2" style="display: none;">
                        <button type="submit" class="btn btn-danger" title="{{ __('Delete Selected Rows') }}"
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
                                    <th>{{ __('Watermark Image') }}</th>
                                    <th>{{ __('Original Image') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($templates as $template)
                                    <tr>
                                        <td><input type="checkbox" name="selectedRows[]" value="{{ $template->id }}"
                                                class="row-checkbox"></td>
                                        <td>{{ $loop->iteration + $templates->links()->paginator->firstItem() - 1 }}</td>
                                        <td>
                                            <a href="{{ asset('storage/' . $template->watermark_image) }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <img src="{{ asset('storage/' . $template->watermark_image) }}"
                                                    width="32">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ asset('storage/' . $template->watermark_image) }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <img src="{{ asset('storage/' . $template->original_image) }}"
                                                    width="32">
                                            </a>

                                        </td>


                                        <td>
                                            <ul class="list-inline m-0 d-inline-flex">


                                                <li class="list-inline-item">
                                                    <a href="{{ route('gifts.templates.edit',$template->id) }}"
                                                        class="btn btn-success btn-square p-0 rounded-circle"
                                                        data-toggle="tooltip" data-placement="top" title="تعديل">
                                                        <div class="d-flex align-items-center justify-content-center p-1">
                                                            <i class="fa fa-edit fa-sm m-0 p-0"></i>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="list-inline-item">
                                                    <a class="btn btn-danger btn-square p-0 rounded-circle"
                                                        data-toggle="tooltip" data-placement="top" title="حذف"
                                                        href="{{ route('gifts.templates.destroy',$template->id) }}"
                                                        data-method="delete"
                                                        data-token="N2XCsA2sZOjg8GWzOzIwzztjM9a7cnKgQKlQh2zN"
                                                        data-confirm="هل أنت متأكد أنك تريد حذف هذا البند؟">
                                                        <div class="d-flex align-items-center justify-content-center p-1">
                                                            <i class="fa fa-trash fa-sm m-0 p-0"></i>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                            {{-- <x-action-buttons :model="$template" route="gifts" :show="false" /> --}}
                                        </td>
                                    </tr>
                                @endforeach
                                @if (count($templates) <= 0)
                                    <tr>
                                        <td style="text-align: center" colspan="7"> {{ __('No Data Yet') }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="d-flex justify-content-center">
                {{ $templates->links() }}
            </div>
        </div>
    </div>
@endsection
