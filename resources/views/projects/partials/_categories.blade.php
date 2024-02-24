<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleCategory">
    {{ __('Change Categories') }}
</button>

<div class="modal fade" id="exampleCategory" tabindex="-1" aria-labelledby="exampleCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('projects.attachCategories', $project->id) }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleCategoryLabel">{{ __('Change Categories') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="categories">{{ __('Select Categories') }}:</label>
                        <div class="form-check">
                            @forelse($categories as $category)
                                <input type="checkbox" class="form-check-input" name="categories[]" id="{{$category->id}}"
                                       value="{{ $category->id }}" @if(in_array($category->id, old('categories', $project->categories->pluck('id')->toArray()))) checked @endif>
                                <label class="form-check-label" for="{{$category->id}}">{{ $category->name }}</label><br>
                            @empty
                                <p>{{ __('There are no categories') }}</p>
                                <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">{{ __('Create Category') }}</a>
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
