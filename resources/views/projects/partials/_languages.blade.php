<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleLanguage">
    {{ __('Change Languages') }}
</button>

<div class="modal fade" id="exampleLanguage" tabindex="-1" aria-labelledby="exampleLanguageLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('projects.attachLanguages', $project->id) }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleLanguageLabel">{{ __('Change Languages') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="languages">{{ __('Select Languages:') }}</label>
                        <div class="form-check">
                            @forelse($languages as $language)
                                <input type="checkbox" class="form-check-input" name="languages[]" id="{{$language->id}}"
                                       value="{{ $language->id }}" @if(in_array($language->id, old('languages', $project->languages->pluck('id')->toArray()))) checked @endif>
                                <label class="form-check-label" for="{{$language->id}}">{{ $language->name }}</label><br>
                            @empty
                                <p>{{ __('There are no languages') }}</p>
                                <a href="{{ route('languages.create') }}" class="btn btn-primary mb-3">{{ __('Create Language') }}</a>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
