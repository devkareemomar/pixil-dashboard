<div class="container card-body row">

	@foreach($social_medias as $social_media)
	<div class="form-group col-6">
		<label for="{{$social_media->name}}">{{ __($social_media->name) }}</label>
		<x-image :src="$social_media->icon" width="50px" height="50px" />
		<input type="text" class="form-control" id="{{$social_media->name}}" value="{{$social_media->url}}" disabled>
	</div>
	@endforeach
</div>