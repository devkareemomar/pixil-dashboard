<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                        <table class="table mb-0 table-borderless">
                            <thead>
                            <tr class="userDatatable-header">
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Preview') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Path') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($project->gallery as $media)
                                <tr>
                                    <td>{{ $media->id }}</td>
                                    <td>
                                        @if($media->type == \App\Enums\GalleryProjectType::Image->name)
                                            <img src="{{ asset('storage/' . $media->path) }}" alt="{{ $project->name }}" width="32">
                                        @elseif($media->type == \App\Enums\GalleryProjectType::Video->name)
                                            <video width="160" height="90" controls>
                                                <source src="{{ asset('storage/' . $media->path) }}" type="video/mp4">
                                                {{ __('Your browser does not support the video tag.') }}
                                            </video>
                                        @endif
                                    </td>
                                    <td>{{ $media->status }}</td>
                                    <td>{{ $media->type }}</td>
                                    <td><a href="{{ asset('storage/' . $media->path) }}">{{ $media->path }}</a></td>
                                    <td>
                                        <form action="{{ route('projects.gallery.destroy', $media->id) }}" method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                        @include('projects.partials._add-media')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
