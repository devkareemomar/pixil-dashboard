@php
$transaction = $transaction ?? null;
@endphp
<div class="form-group">
	<label>{{ __('Category') }} <span class="text-danger">*</span></label>
	<select name="category_id" class="form-control">
		<option disabled>{{ __('Select Category') }}</option>
		@foreach ($categories as $category)
		<option value="{{ $category->id }}" @selected(old('category_id', $transaction?->category_id) == $category->id)>
			{{ $category->name }}
		</option>
		@endforeach
	</select>
	@error('category_id')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>
<div class="form-group">
	<label>{{ __('Tags') }} <span class="text-danger">*</span></label>
	<select name="tag_id" class="form-control">
		<option disabled>{{ __('Select Tag') }}</option>
		@foreach ($tags as $tag)
		<option value="{{ $tag->id }}" @selected(old('tag_id', $transaction?->tag_id) == $tag->id)>
			{{ $tag->name }}
		</option>
		@endforeach
	</select>
	@error('tag_id')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>
<div class="form-group">
	<label>{{ __('Continent') }} <span class="text-danger">*</span></label>
	<input type="text" name="continent" class="form-control" value="{{ old('continent', $transaction?->continent) }}">
	@error('continent')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>
<div class="form-group">
	<label>{{ __('Country') }} <span class="text-danger">*</span></label>
	<select name="country_id" class="form-control">
		<option disabled>{{ __('Select Country') }}</option>
		@foreach ($countries as $country)
		<option value="{{ $country->id }}" @selected(old('country_id', $transaction?->country_id) == $country->id)>
			{{ $country->name }}
		</option>
		@endforeach
	</select>
	@error('country_id')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>
<div class="form-group">
	<label>{{ __('Project') }} <span class="text-danger">*</span></label>
	<select name="project_id" class="form-control">
		<option disabled>{{ __('Select Project') }}</option>
		@foreach ($projects as $project)
		<option value="{{ $project->id }}" @selected(old('project_id', $transaction?->project_id) == $project->id)>
			{{ $project->name }}
		</option>
		@endforeach
	</select>
	@error('project_id')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>
<div class="form-group">
	<label>{{ __('Project Code') }} <span class="text-danger">*</span></label>
	<input type="number"  name="project_code" class="form-control"
		value="{{ old('project_code', $transaction?->project_code) }}">
	@error('project_code')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>
<div class="form-group">
	<label>{{ __('Price') }} <span class="text-danger">*</span></label>
	<input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $transaction?->price) }}">
	@error('price')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>
<div class="form-group">
	<label>{{ __('Quantity') }} <span class="text-danger">*</span></label>
	<input type="number" step="0.01" name="quantity" class="form-control" value="{{ old('quantity', $transaction?->quantity) }}">
	@error('quantity')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>
<div class="form-group">
	<label>{{ __('Amount') }} <span class="text-danger">*</span></label>
	<input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $transaction?->amount) }}">
	@error('amount')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>
<div class="form-group">
	<label>{{ __('Comment') }}</label>
	<textarea name="comment" class="form-control">{{ old('comment', $transaction?->comment) }}</textarea>
	@error('comment')
	<p class="text-danger">{{ $message }}</p>
	@enderror
</div>
