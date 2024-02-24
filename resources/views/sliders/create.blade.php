@extends('layout.app')

@section('title', __('Create slider'))
@section('description', __('Create a new Slider'))

@section('content')
    <div class="container-fluid pb-30 pt-30">
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Create slider') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form class="col-11 m-auto" action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{ __("Name") }}<span class="text-danger">*</span></label>
                            <input required type="text" name="title" class="form-control" value="{{ old('title') }}">
                            @error('title')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __("Description") }} <span class="text-danger">*</span></label>
                            <textarea required type="text" name="description"
                                      class="form-control">{{ old('description') }}</textarea>
                            @error('description')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group" id="mediaContainer">
                            <label>{{ __("Media") }} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select required id="mediaType" name="media_type" class="form-control"
                                        onchange="toggleMediaInput()">
                                    <option
                                        value="image" @selected(old('media_type') == 'image')>{{ __("Image") }}</option>
                                    <option
                                        value="video" @selected(old('media_type') == 'video')>{{ __("Video") }}</option>
                                </select>
                                @error('media_type')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <br><br>
                                <label>{{__('Media path')}} <span class="text-danger">*</span></label>
                                <input style="width: 100%;" type="file" id="mediaInput" name="media_path" class="form-control">
                                @error('media_path')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <p id="mediaError" class="text-danger"></p>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Create slider') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleMediaInput() {
            const mediaType = document.getElementById('mediaType').value;
            const mediaInput = document.getElementById('mediaInput');
            const mediaError = document.getElementById('mediaError');

            if (mediaType === 'image') {
                mediaInput.type = 'file';
                mediaError.textContent = '';
            } else if (mediaType === 'video') {
                mediaInput.placeholder = '{{ __("Enter video URL") }}';
                mediaInput.type = 'url';
                mediaError.textContent = '';
            }
        }
    </script>
@endsection
