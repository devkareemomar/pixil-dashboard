@extends('layout.app')

@section('title', __('Album'))
@section('description', 'Show album')

@section('content')
    <div class="container-fluid pb-30 pt-30">
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h2>{{__('Album')}} ({{$result->title}})</h2>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h2>{{__('Description')}} :</h2>
                        {!! $result->description !!}
                    </div>
                    <div class="col-6">
                        <br>
                        <h4>{{__('Is active')}} :</h4>
                        {!! $result->is_active ==1 ? __('Active'):__('Not Active') !!}
                    </div>
                    <hr style="margin-top: 40px">
                    <div class="col-12">
                        <div style="text-align: center;padding-bottom: 40px">
                            <h2>{{__('Photos')}}</h2>
                            @can('album-update')
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    {{__('Add New Media')}}
                                </button>
                            @endcan
                        </div>

                        <div class="row">
                            @foreach($result->media as $media)
                                @if($media->image != null)
                                    <div class="col-4">
                                        <form action="{{ route('destroyMedia', $media->id) }}" method="POST"
                                              class="d-inline">
                                            @csrf
                                            <button style="position: absolute" type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('{{ __('Are you sure?') }}')">
                                                -
                                            </button>
                                        </form>
                                        <img width="100%" height="300px" src="{{asset('storage/'.$media->image)}}">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="row" style="padding:5% 0">
                            <div style="text-align: center;padding-bottom: 40px">
                                <h2>{{__('Videos')}}</h2>
                            </div>
                            @foreach($result->media as $media)
                                @if($media->video != null)

                                    <div class="col-4">
                                        <form action="{{ route('destroyMedia', $media->id) }}" method="POST"
                                              class="d-inline">
                                            @csrf
                                            <button style="position: absolute" type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('{{ __('Are you sure?') }}')">
                                                -
                                            </button>
                                        </form>
                                        <iframe width="100%" height="300px" frameborder="0" src="{{$media->video}}"
                                                allowfullscreen></iframe>
                                    </div>
                                @endif

                            @endforeach

                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
    @can('album-update')
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Media</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form enctype="multipart/form-data" class="col-10 offset-1"
                          action="{{ route('storeMedia',$result->id) }}"
                          method="POST">
                        @csrf
                        <div class="modal-body">


                            <label>{{__('AddImage')}}</label>
                            <input class="form-control" type="file" name="images[]" multiple>
                            @error('images.*')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror

                            <br><br>
                            <div class="col-12">
                                <label>{{__('AddVideoUrl')}}</label>
                                <div id="div_add">
                                    <input class="form-control" style="display: inline-block;width: 80%" type="text"
                                           name="videos[]">
                                    <input type="button" class="btn btn-secondary" id="add"
                                           style="display: inline-block"
                                           value="+">
                                </div>
                                @error('videos.*')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
        $("#add").click(function () {
            $("#div_add").append('<br><br> <div id="new_div" "> <input id="add-input" class="form-control"  style="display: inline-block;width: 80%" type="text" name="videos[]">'
                + '<input type="button"  class="btn btn-danger" id="remove" style="display: inline-block" value="-"></div>');

        });
        $("body").on("click", "#remove", function () {
            $(this).parents("#new_div").remove();
        })

    </script>
@endsection
