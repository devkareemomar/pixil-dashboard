@extends('layout.app')

@section('title', __('Edit Campaigns'))
@section('description', __('Edit an existing Campaigns'))

@section('content')
    <div class="container-fluid pb-30 pt-30"  >
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Edit Campaigns') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">

                    <form enctype="multipart/form-data" class="col-11 m-auto"
                          action="{{ route('campaigns.update', $result->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        @include('campaigns.partials._language-tabs')
                        <div class="form-group">
                            <label>{{ __('Image') }}</label>
                            @if($result->image != null)
                                <br><br>
                                <img src="{{asset('storage/'.$result->image)}}" width="100px" alt="">
                                <br><br>
                            @endif
                            <input type="file" name="image" class="form-control">
                            @error('image')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label>{{ __('Start Date') }} <span class="text-danger">*</span></label>
                                <input type="date" name="start_date" class="form-control"
                                       value="{{ \Illuminate\Support\Carbon::parse($result->start_date)->format("Y-m-d")}}">
                            </div>
                            <div class="col-6">
                                <label>{{ __('End Date') }} <span class="text-danger">*</span></label>
                                <input type="date" name="end_date" class="form-control"
                                       value="{{ \Illuminate\Support\Carbon::parse($result->end_date)->format("Y-m-d")}}">
                            </div>
                            <div class="col-12">
                                <br>
                                <label>{{ __('Projects') }} <span class="text-danger">*</span></label>
                                <select required style="font-size: 20px" class="js-example-basic-multiple" name="projects[]"
                                        multiple="multiple">
                                    <option disabled>{{ __('Select Projects') }}</option>
                                    @foreach(\App\Models\Project::select('id','name')->get() as $project)
                                        <option style="font-size: 20px"
                                                value="{{$project->id}}" {{!empty(\Illuminate\Support\Facades\DB::table('campaign_projects')->where('project_id',$project->id)->where('campaign_id',$result->id)->first())  ? 'selected' : ''}}>{{$project->name}}</option>
                                    @endforeach
                                </select>
                                <br><br>
                            </div>
                            <div class="col-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" value="1"
                                           name="is_active"
                                           id="flexSwitchCheckChecked" {{$result->is_active ==1 ? "checked":''}}>
                                    <label class="form-check-label"
                                           for="flexSwitchCheckChecked">{{ __('Is Active') }}</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="1" role="switch"
                                           id="flexSwitchCheckChecked"
                                           name="is_home_slider" {{$result->is_home_slider ==1 ? "checked":''}}>
                                    <label class="form-check-label"
                                           for="flexSwitchCheckChecked">{{ __('Is Home Slider') }}</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">{{ __('Update Campaign') }}</button>
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
