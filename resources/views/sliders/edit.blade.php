@extends('layout.app')

@section('title', __('Edit Slider'))
@section('description', __('Edit a Slider'))

@section('content')
    <div class="container-fluid pb-30 pt-30"  >
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Edit Slider') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">

				<form class="col-11 m-auto" action="{{ route('sliders.update', $slider->id) }}" method="POST"
					enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="form-group">
						<label>{{ __("Name") }}<span class="text-danger">*</span></label>
						<input type="text" name="title" class="form-control" value="{{ old('title', $slider->title) }}">
						@error('title')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>
					<div class="form-group">
						<label>{{ __("Description") }} <span class="text-danger">*</span></label>
						<textarea type="text" name="description"
							class="form-control">{{ old('description', $slider->description) }} </textarea>
						@error('description')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>

					<div class="form-group" id="mediaContainer">
						<label>{{ __("Media") }} <span class="text-danger">*</span></label>
						<div class="input-group">
							<select required id="mediaType" name="media_type" class="form-control" onchange="toggleMediaInput()">
								<option value="image" {{ old('media_type', $slider->media_type) == 'image' ? 'selected'
									: '' }}>{{ __("Image") }}</option>
								<option value="video" {{ old('media_type', $slider->media_type) == 'video' ? 'selected'
									: '' }}>{{ __("Video") }}</option>
							</select>
                            <br><br>
                            <label>{{__('Media path')}} <span class="text-danger">*</span></label>
							<input required style="width: 100%" type="{{ $slider->media_type == 'image' ? 'file' : 'url' }}" id="mediaInput"
								name="media_path" class="form-control"
								value="{{ old('media_path', $slider->media_path) }}">
						</div>
						<p id="mediaError" class="text-danger"></p>
					</div>

					<button type="submit" class="btn btn-primary">{{ __('Edit Slider') }}</button>
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
