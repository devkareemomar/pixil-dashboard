<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleCountry">
    {{ __('Change Countries') }}
</button>

<div class="modal fade" id="exampleCountry" tabindex="-1" aria-labelledby="exampleCountryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('projects.attachCountries', $project->id) }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleCountryLabel">{{ __('Change Countries') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="countries">{{ __('Select Countries') }}:</label>
                        <div class="form-check">
                            @forelse($countries as $country)
                                <input type="checkbox" class="form-check-input" name="countries[]" id="{{$country->id}}"
                                       value="{{ $country->id }}" @if(in_array($country->id, old('countries', $project->countries->pluck('id')->toArray()))) checked @endif>
                                <label class="form-check-label" for="{{$country->id}}">{{ $country->name }}</label><br>
                            @empty
                                <p>{{ __('There are no countries') }}</p>
                                <a href="{{ route('countries.create') }}" class="btn btn-primary mb-3">{{ __('Create Country') }}</a>
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
