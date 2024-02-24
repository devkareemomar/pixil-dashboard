<div class="mb-3 col-4">
	<label for="order" class="form-label">{{ __('Project Order') }}</label>
	<input type="number" class="form-control" id="order" name="order" value="{{ old('order', $project?->order) }}">
	<x-error-message name="order" />
</div>


@php
    $label = '';
    $values = '';
    if($project?->suggested_values){
        $suggested = json_decode($project->suggested_values, true);
        $label = implode(', ', array_keys($suggested));
        $values = implode(', ', array_values($suggested));
    }
@endphp
<div class="mb-3 col-12" id="suggested_container">
    <label for="suggested_values" class="form-label">{{ __('Suggested values') }}</label>
    <div id="suggested_label">
        <span>{{ __('Lable') }}</span>
        <input type="text" name="suggested_label"   class="suggested_values form-control"
        value="{{ old('suggested_label', $label) }}">
    </div>
    <div>
        <span>{{ __('Values') }}</span>

        <input type="text" name="suggested_values" class="suggested_values form-control mt-2"
            value="{{ old('suggested_values', $values) }}">
    </div>


    <x-error-message name="suggested_values" />
</div>

<div class="row">

	<div class="mb-3 col-4">
		<x-toggle-switch name="is_stock" label="{{__('Is Stock')}}" :value="$project?->is_stock"
			x-on:click="stock = !stock" />
		<x-error-message name="is_stock" />

	</div>
	<div class="mb-3 col-md-3" x-show="stock">
		<label for="stock" class="form-label">{{ __('Stock') }}</label>
		<input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $project?->stock) }}">
		<x-error-message name="stock" />
	</div>
</div>
<div class="row">
	<div class="mb-3 col-4">
		<x-toggle-switch name="highlighted" label="{{ __('Show Banner') }}" :value="$project?->highlighted"
			x-on:click="highlighted = !highlighted" />
		<x-error-message name="highlighted" />
	</div>
	<div class="mb-3 col-md-6" x-show="highlighted">
		<label for="images" class="form-label">{{ __('Banner Image') }}</label>
		<input type="file" class="form-control filepond" id="images" name="images[]" multiple @if ($project &&
			$project->images)
		@foreach($project->images as $image)
		data-images='{!! collect($project->images)->map(function($image) {
		return Storage::disk('public')->url($image->path);
		})->toJson() !!}' @endforeach
		@endif
		>
		<small class="text-muted">{{ __('Size') }}: (452 px * 348 px)</small>
	</div>

</div>
@include('projects.partials._multiple_countries')
<div class="mb-3 col-md-6">
	<label for="main_image" class="form-label">{{ __('Main Image') }}</label>
	<input type="file" class="form-control filepond" id="main_image" name="main_image" @if ($project &&
		$project->main_image) data-images="{{collect(Storage::disk('public')->url
	($project->main_image))
	->toJson()}}" @endif>
	<small class="text-muted">{{ __('Size') }}: (452 px * 348 px)</small>
	<x-error-message name="main_image" />
</div>

<div class="mb-3 col-md-6">
	<label for="thumbnail" class="form-label">{{ __('Thumbnail') }}</label>
	<input type="file" class="form-control filepond" id="thumbnail" name="thumbnail" @if ($project &&
		$project->thumbnail) data-images="{{collect(Storage::disk('public')->url
	($project->thumbnail))
	->toJson()}}" @endif
	>
	<small class="text-muted">{{ __('Size') }}: (452 px * 348 px)</small>
	<x-error-message name="thumbnail" />
</div>
