<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleGallery">
    {{ __('Add Media to Gallery') }}
</button>

<div class="modal fade" id="exampleGallery" tabindex="-1" aria-labelledby="exampleGalleryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('projects.gallery.store', $project->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="text-capitalize fw-500">{{ __('Add Media to Gallery') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="media">{{ __('Image File') }}:</label>
                        <input type="file" class="form-control" name="image" accept="image/*" >
                        <x-error-message name="image" />
                    </div>

                    <div class="form-group">
                        <label for="media">{{ __('Video File') }}:</label>
                        <input type="file" class="form-control" name="video" accept="video/*" >
                        <x-error-message name="video" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Upload') }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
