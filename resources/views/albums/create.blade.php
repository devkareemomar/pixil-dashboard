@extends('layout.app')
@section('title', __('Album'))
@section('description', __('Manage Album'))

@section('content')
    <div class="container-fluid pb-30 pt-30">

        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{__('CreateNewAlbum')}} </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form  enctype="multipart/form-data" class="col-11 m-auto" action="{{ route('albums.store') }}"
                          method="POST">
                        @csrf
                        @include('albums.partials._form')
                        <br>
                        <button id="submitButton" type="submit" class="btn btn-primary">{{__('CreateNewAlbum')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#submitButton').click(function () {
            $('input:invalid').each(function () {
                var $closest = $(this).closest('.tab-pane');
                var id = $closest.attr('id');
                $('.nav a[href="#' + id + '"]').tab('show');
                return false;
            });
        });
    </script>
@endsection
