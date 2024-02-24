@extends('layout.app')

@section('title', __('Status Details'))
@section('description', __('Edit an existing Status'))

@section('content')
    <div class="container-fluid pb-30 pt-30">
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h2>{{ __('Status Details') }} ({{$result->id}})</h2>
                <a href="{{ url('dashboard/forms/'.$result->form_builder_id) }}" class="btn btn-primary">{{__('Go Back')}}</a>

            </div>
            <div class="card-body">
                <div class="row">
                    <h4>{{__('Edit Status')}} </h4>

                    <form enctype="multipart/form-data" class="col-11 m-auto"
                          action="{{ route('formData.update', $result->id) }}"
                          method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="form-group col-12">
                                <br>
                                <label> {{ __('Status') }}</label>
                                <select id="status" onchange="showDiv()" required style="font-size: 20px"
                                        class="js-example-basic-multiple"
                                        name="status">
                                    <option disabled>{{ __('Select Status') }}</option>
                                    <option value="Under review" {{$result->status == "Under review"?'selected' :"" }}>{{ __('Under review') }}</option>
                                    <option value="It has been approved" {{$result->status == "It has been approved"?'selected' :"" }}>{{ __('It has been approved') }}</option>
                                    <option value="access denied" {{$result->status == "access denied"?'selected' :"" }}>{{ __('access denied') }}</option>
                                </select>
                            </div>
                            <div id="checks_data"
                                 style="{{$result->status == "It has been approved"?'' :"display: none" }}">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <br>
                                        <label> {{ __('Check`s Price') }}</label>
                                        <input type="number"  name="price" id="price"
                                               value="{{old('price', $result->price ?? '')}}" class="form-control">
                                    </div>
                                    <div class="form-group col-6">
                                        <br>
                                        <label> {{ __('Check`s Date') }}</label>
                                        <input id="checks_date" type="date" value="{{old('checks_date', $result->checks_date ?? '')}}"
                                                name="checks_date" class="form-control">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">{{ __('Edit Status') }}</button>
                    </form>
                    <hr style="margin:2% 0">
                    <div class="row">
                        <h4>{{__('Status Data')}} </h4>
                        <Br><Br>
                        @foreach(json_decode($result->data) as $data)
                            <div class="col-6"  style="padding: 2%">
                                <label> {{$data->label }} : </label>
                                <h5 style="display: inline-block"> {{$data->value}} </h5>
                            </div>

                        @endforeach

                    </div>
                </div>
                <Br>
            </div>
        </div>
    </div>

    <script>
        function showDiv() {
            var selectValue = document.getElementById("status").value;
            var div = document.getElementById("checks_data");
            var checks_date=  document.getElementById("checks_date");
            var price=  document.getElementById("price");

            if (selectValue === "It has been approved") {
                div.style.display = "block";
                checks_date.setAttribute("required", "");
                price.setAttribute("required", "");

            } else {
                div.style.display = "none";
                checks_date.removeAttribute("required");
                price.removeAttribute("required");
                price.value = "";
                checks_date.value = "";

            }

        }
    </script>
@endsection
