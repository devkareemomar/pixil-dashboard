@props(['edit' => true, 'delete' => true, 'show' => true, 'route', 'model'])


@php
    // change $model to snake case with space instead of underscore
    $permissionName = str_replace('_', ' ', str()->snake(class_basename($model)));
@endphp
    <ul class="list-inline m-0 d-inline-flex">
        {{ $slot }}
        @if($show)
            @can("$permissionName-read")
                <li class="list-inline-item">
                    <a href="{{ route($route . '.show', $model) }}" class="btn btn-info btn-square p-0 rounded-circle"
                       data-toggle="tooltip" data-placement="top" title="{{ __('Show') }}">
                        <div class="d-flex align-items-center justify-content-center p-1">
                            <i class="fa fa-eye fa-sm m-0 p-0"></i>
                        </div>
                    </a>
                </li>
            @endcan
        @endif

        @if($edit)
            @can("$permissionName-update")
                <li class="list-inline-item">
                    <a href="{{ route($route . '.edit', $model) }}"
                       class="btn btn-success btn-square p-0 rounded-circle"
                       data-toggle="tooltip" data-placement="top" title="{{ __('Edit') }}">
                        <div class="d-flex align-items-center justify-content-center p-1">
                            <i class="fa fa-edit fa-sm m-0 p-0"></i>
                        </div>
                    </a>
                </li>
            @endcan
        @endif

        @if($delete)
            @can("$permissionName-delete")
                <li class="list-inline-item">
                    <a class="btn btn-danger btn-square p-0 rounded-circle" data-toggle="tooltip"
                       data-placement="top" title="{{ __('Delete') }}"
                       href="{{ route($route . '.deleteSelectRow',['selectedRows' => [$model->id]]) }}"
                       data-method="delete" data-token="{{csrf_token()}}"
                       data-confirm="{{ __('Are you sure you want to delete this item?') }}"
                    >
                        <div class="d-flex align-items-center justify-content-center p-1">
                            <i class="fa fa-trash fa-sm m-0 p-0"></i>
                        </div>
                    </a>
            @endcan
        @endif
    </ul>

