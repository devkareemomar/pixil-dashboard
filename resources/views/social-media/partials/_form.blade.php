@php
$social_media = $social_media ?? null;
@endphp
<div class="form-group">
	<label>{{ __('Name') }} <span class="text-danger">*</span></label>
	<input type="text" name="name" class="form-control" value="{{ old('name', $social_media->name ?? null) }}">
	@error('name')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>
<div class="form-group">
	<label>{{ __('Icon') }} <span class="text-danger">*</span></label>
	<input type="file" name="icon" class="form-control-file">
	@if(isset($social_media->icon))
	<x-image src="{{$social_media->icon}}" />
	@endif
	<small class="text-muted">{{ __('Size') }}: 32x32 or 64x64</small>
	@error('icon')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>
<div class="form-group">
	<label>{{ __('Url') }} <span class="text-danger">*</span></label>
	<input type="text" name="url" class="form-control" value="{{ old('url', $social_media->url ?? null) }}">
	@error('url')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>