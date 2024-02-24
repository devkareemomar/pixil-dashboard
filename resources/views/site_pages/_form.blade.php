<div class="form-group">
    <label for="title">{{ __('Title') }} <span class="text-danger">*</span></label>
    <input required type="text" name="title" class="form-control"
           value="{{ old('title') }}" id="title">
    @error('title')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>


<div class="mb-3">
    <label for="description" class="form-label">{{ __('Content') }}</label>
    <textarea class="form-control ckeditor" id="description"
              name="content">{{ old('content', $page?->description) }}</textarea>
    <x-error-message name="content"/>
</div>

<div class="mt-3 mb-3">
    <label for="lang" class="form-label">{{ __('Language') }}</label>
    <select id="lang" class="form-control" name="lang">
        @foreach($languages as $language)
            <option value="{{ $language->short_name}}">{{ $language->name }}</option>
        @endforeach
    </select>
</div>

