<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleTag">
    {{ __('Change Tags') }}
</button>

<div class="modal fade" id="exampleTag" tabindex="-1" aria-labelledby="exampleTagLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('projects.attachTags', $project->id) }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleTagLabel">{{ __('Change Tags') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="tags">{{ __('Select Tags') }}:</label>
                        <div class="form-check">
                            @forelse($tags as $tag)
                                <input type="checkbox" class="form-check-input" name="tags[]" id="{{$tag->id}}"
                                       value="{{ $tag->id }}"
                                       @if(in_array($tag->id, old('tags', $project->tags->pluck('id')->toArray()))) checked @endif>
                                <label class="form-check-label" for="{{$tag->id}}">{{ $tag->name }}</label><br>
                            @empty
                                <p>{{ __('There are no tags') }}</p>
                                <a href="{{ route('tags.create') }}" class="btn btn-primary mb-3">{{ __('Create Tag') }}</a>
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
