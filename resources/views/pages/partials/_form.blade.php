@php
    $page = $page ?? null;
@endphp

    <div class="form-group">
        <label>{{ __('Project') }} <span class="text-danger">*</span></label>
        <select name="project_id" class="form-control">
            @foreach ($projects as $project)
                <option value="{{ $project->id }}" @selected(old('project_id', $page?->project_id) == $project->id)>
                    {{ $project->name }}
                </option>
            @endforeach
        </select>
        @error('project_id')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label>{{ __('Name') }} <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $page?->name) }}">
        @error('name')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label>{{ __('Title') }} <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $page?->title) }}">
        @error('title')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label>{{ __('Description') }}</label>
        <textarea  name="description" class="form-control ckeditor">{{ old('description', $page?->description) }}</textarea>
        @error('description')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

