<?php

namespace App\Http\Controllers;

use App\Enums\GalleryProjectType;
use App\Http\Requests\MediaUploadRequest;
use App\Models\Project;
use App\Models\ProjectGallery;

class GalleryController
{

    public function storeMedia(MediaUploadRequest $request, Project $project)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['path'] = $request->file('image')->store('images', 'public');

            $data['type'] = GalleryProjectType::Image;
        }

        if ($request->hasFile('video')) {
//            dd($request->file('video')->getMimeType());
            $data['path'] = $request->file('video')->store('videos', 'public');

            $data['type'] = GalleryProjectType::Video;
        }

        $project->gallery()->create($data);


        return back()->with('success',  __('Media added successfully'));
    }

    public function destroy(ProjectGallery $media)
    {
        $media->delete();
        return back()->with('success',  __('Media deleted successfully'));
    }
}
