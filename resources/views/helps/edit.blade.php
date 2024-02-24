@extends('layout.app')

@section('title', __('Edit Help List'))
@section('description', __('Edit an existing Help List'))

@section('content')
    <div class="container-fluid pb-30 pt-30">
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Edit Help List') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form enctype="multipart/form-data" class="col-11 m-auto"
                          action="{{ route('helps.update', $result->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="form-group col-6">
                                <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                                <input required type="text" name="name" class="form-control"
                                       value="{{ $result->name }}">
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-6">
                                <label>{{ __('Civil Id') }} <span class="text-danger">*</span></label>
                                <input required type="number" name="civil_id" class="form-control"
                                       value="{{ $result->civil_id }}">
                                @error('civil_id')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-6">
                                <label>{{ __('Gender') }} <span class="text-danger">*</span></label>
                                <select required style="font-size: 20px" class="js-example-basic-multiple"
                                        name="gender">
                                    <option disabled>{{ __('Select Gender') }}</option>
                                    <option
                                        value="male" {{$result->gender =='male'?'selected':""}}>{{ __('Male') }}</option>
                                    <option
                                        value="female" {{$result->gender =='female'?'selected':""}}>{{ __('Female') }}</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>{{ __('Nationality') }}<span class="text-danger">*</span></label>
                                <select required style="font-size: 20px" class="js-example-basic-multiple"
                                        name="nationality_id">
                                    <option disabled>{{ __('Select Nationality') }}</option>
                                    @foreach(\App\Models\Nationality::all() as $nationality)
                                        <option style="font-size: 20px"
                                                value="{{$nationality->id}}" {{$result->nationality_id == $nationality->id? 'elected':""}}>{{$nationality->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-6">
                                <label>{{ __('Marital Status') }}<span class="text-danger">*</span></label>
                                <select required style="font-size: 20px" class="js-example-basic-multiple"
                                        name="marital_status">
                                    <option disabled>{{ __('Select Marital Status') }}</option>
                                    <option
                                        value="single" {{$result->marital_status =='single'?'selected':""}}>{{ __('Single') }}</option>
                                    <option
                                        value="married" {{$result->marital_status =='married'?'selected':""}}>{{ __('Married') }}</option>
                                    <option
                                        value="orphan" {{$result->marital_status =='orphan'?'selected':""}}>{{ __('Orphan') }}</option>
                                    <option
                                        value="widow" {{$result->marital_status =='widow'?'selected':""}}>{{ __('Widow') }}</option>

                                </select>
                            </div>

                            <div class="form-group col-6">
                                <label>{{ __('Help Type') }}<span class="text-danger">*</span></label>
                                <select required style="font-size: 20px" class="js-example-basic-multiple"
                                        name="help_type_id">
                                    <option disabled>{{ __('Select Help Type') }}</option>
                                    @foreach(\App\Models\HelpType::all() as $help_type)
                                        <option
                                            value="{{$help_type->id}}" {{$help_type->id == $result->help_type_id? 'elected':''}}>{{$help_type->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-6">
                                <label>{{ __('Service Status') }}</label>
                                <input type="text" name="service_status" class="form-control"
                                       value="{{ $result->service_status }}">
                                @error('service_status')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>{{ __('Family Members') }}<span class="text-danger">*</span></label>
                                <input required type="number" name="family_members" class="form-control"
                                       value="{{ $result->family_members }}">
                                @error('family_members')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-6">
                                <label>{{ __('Job') }}<span class="text-danger">*</span></label>
                                <input required type="text" name="job" class="form-control"
                                       value="{{ $result->job }}">
                                @error('job')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-6">
                                <label>{{ __('Salary') }}<span class="text-danger">*</span></label>
                                <input required type="number" name="salary" class="form-control"
                                       value="{{ $result->salary }}">
                                @error('salary')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-6">
                                <label>{{ __('Address') }}<span class="text-danger">*</span></label>
                                <input required type="text" name="address" class="form-control"
                                       value="{{ $result->address }}">
                                @error('address')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>{{ __('Phone') }}<span class="text-danger">*</span></label>
                                <input required type="number" name="phone" class="form-control"
                                       value="{{ $result->phone }}">
                                @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-12">
                                <label>{{ __('Other Information') }}</label>
                                <input type="text" name="other_information" class="form-control"
                                       value="{{ $result->other_information }}">
                                @error('other_information')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-12">
                                <label>{{ __('Attached File') }}</label>
                                <input type="file" name="file" class="form-control" value="{{ old('file') }}">
                                @error('file')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group col-6">
                                <label>{{ __('Old help document') }}</label>
                                <input type="text" name="old_help_document" class="form-control"
                                       value="{{ $result->old_help_document }}">
                                @error('old_help_document')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>{{ __('Reference.No') }}</label>
                                <input type="number" name="reference_no" class="form-control"
                                       value="{{ $result->reference_no }}">
                                @error('reference_no')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <br>
                        <button type="submit" class="btn btn-primary">{{ __('Update help') }}</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('.js-example-basic-multiple').select2();
            });
        </script>
@endsection
