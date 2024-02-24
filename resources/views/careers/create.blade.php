@extends('layout.app')

@section('title', __('Create Career'))
@section('description', __('Create a new Careers'))

@section('content')
    <div class="container-fluid pb-30 pt-30"  >

        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Create Career') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">

                    <form enctype="multipart/form-data" class="col-11 m-auto" action="{{ route('careers.store') }}"
                          method="POST">
                        @csrf
                        <div class="form-group">
                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input required type="text" name="name" class="form-control"
                                   value="{{ old('name') }}">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('Email') }} <span class="text-danger">*</span></label>
                            <input required type="email" name="email" class="form-control"
                                   value="{{ old('email') }}">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('Phone') }} <span class="text-danger">*</span></label>
                            <input required type="text" name="phone" class="form-control"
                                   value="{{ old('phone') }}">
                            @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('Job title') }}</label>
                            <select required style="font-size: 20px" class="js-example-basic-multiple"
                                    name="job_category_id">
                                <option disabled>{{ __('Select Job Title') }}</option>
                                @foreach(\App\Models\JobCategory::all() as $job)
                                    <option style="font-size: 20px" value="{{$job->id}}">{{$job->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Nationality') }}</label>
                            <select required style="font-size: 20px" class="js-example-basic-multiple"
                                    name="nationality_id">
                                <option disabled>{{ __('Select Nationality') }}</option>
                                @foreach(\App\Models\Nationality::all() as $nationality)
                                    <option style="font-size: 20px"
                                            value="{{$nationality->id}}">{{$nationality->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('File') }}</label>
                            <input type="file" name="file" class="form-control" value="{{ old('file') }}">
                            @error('file')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <br>
                        <button type="submit" class="btn btn-primary">{{ __('Create Career') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
