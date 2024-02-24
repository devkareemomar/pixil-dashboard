@extends('layout.app')

@section('title', __('Create Campaigns'))
@section('description', __('Create a new Campaigns'))

@section('content')
    <div class="container-fluid pb-30 pt-30">

        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Create Campaigns') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form enctype="multipart/form-data" class="col-11 m-auto" action="{{ route('campaigns.store') }}"
                          method="POST">
                        @csrf
                        @include('campaigns.partials._language-tabs')
                        <div class="form-group">
                            <label>{{ __('Image') }}</label>
                            <input type="file" name="image" class="form-control" value="{{ old('image') }}">
                            @error('image')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label>{{ __('Start date') }}<span class="text-danger">*</span></label>
                                <input type="date" name="start_date" class="form-control"
                                       value="{{ old('start_date') }}">
                            </div>
                            <div class="col-6">
                                <label>{{ __('End date') }}<span class="text-danger">*</span></label>
                                <input type="date" name="end_date" class="form-control"
                                       value="{{ old('end_date') }}">
                            </div>
                            <div class="col-12">
                                <br>
                                <label>{{ __('Projects') }} <span class="text-danger">*</span></label>
                                <select required style="font-size: 20px" class="js-example-basic-multiple" name="projects[]"
                                        multiple="multiple">
                                    <option disabled>{{ __('Select Projects') }}</option>
                                    @foreach(\App\Models\Project::select('id','name')->get() as $project)
                                        <option style="font-size: 20px"
                                                value="{{$project->id}}">{{$project->name}}</option>
                                    @endforeach
                                </select>
                                <br><br>
                            </div>
                            <div class="col-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" value="1"
                                           name="is_active" id="flexSwitchCheckChecked" checked>
                                    <label class="form-check-label"
                                           for="flexSwitchCheckChecked">{{ __('Is Active') }}</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="1" role="switch"
                                           id="flexSwitchCheckChecked" name="is_home_slider" checked>
                                    <label class="form-check-label"
                                           for="flexSwitchCheckChecked">{{ __('Is Home Slider') }}</label>
                                </div>
                            </div>
                        </div>

                        <br>
                        <button type="submit" class="btn btn-primary">{{ __('Create Campaigns') }}</button>
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
