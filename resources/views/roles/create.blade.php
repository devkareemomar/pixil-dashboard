@extends('layout.app')

@section('title', __('Create Role'))
@section('description', __('Create a new role'))

@section('content')
    <div class="container-fluid pb-30 pt-30">
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Create New Role') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('roles.store') }}" method="POST" class="col-11 m-auto ">
                        @csrf
                        <div class="form-group">
                            <label>{{ __('Role Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label>{{ __('Permissions') }}</label><br>
                            <div class="form-check mb-3">
                                <label class="form-check-label" for="checkAll">{{ __('Check All') }}</label>
                                <input class="form-check-input" type="checkbox" id="checkAll" value="1">
                            </div>
                            <div class="row">
                                @foreach ($permissionColumns as $category => $categoryPermissions)
                                    <div class="col-md-3 mb-3">
                                        <div style="margin-bottom: 10px;" class="category-title">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                            />
                                            <h4  style="display: inline-block;margin-right: 3%;">

                                                {{ __(ucfirst($category)) }}
                                            </h4>
                                        </div>

                                        @foreach ($categoryPermissions as $permissionId)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                       id="{{ $permissions[$permissionId] }}"
                                                       value="{{ $permissionId }}">
                                                <label class="form-check-label"
                                                       for="{{ $permissions[$permissionId] }}">{{ __($permissions[$permissionId]) }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>

                            @error('permissions')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Create Role') }}</button>
                    </form>
                </div>
            </div>
        </div>
        @endsection

        @push('scripts')
            <script>
                // when clicking on a .category-title element, we want to check all the checkboxes in the same .col-md-3
                var categoryTitles = document.querySelectorAll('.category-title');
                categoryTitles.forEach(function (categoryTitle) {
                    categoryTitle.addEventListener('click', function () {
                        var checkboxes = categoryTitle.parentElement.querySelectorAll('input[type="checkbox"]');
                        let checked = checkboxes[0].checked;
                        checkboxes.forEach(function (checkbox) {
                            if (checked) {
                                checkbox.checked = true;
                            } else {
                                checkbox.checked = false;
                            }
                        });
                    });
                });
                var checkAll = document.getElementById('checkAll');
                checkAll.addEventListener('click', function () {
                    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                    let checked = checkboxes[0].checked;
                    checkboxes.forEach(function (checkbox) {
                        if (checked) {
                            checkbox.checked = true;
                        } else {
                            checkbox.checked = false;
                        }
                    });
                });
            </script>
    @endpush
