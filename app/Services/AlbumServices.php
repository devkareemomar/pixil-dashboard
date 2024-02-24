<?php

namespace App\Services;

use App\Interface\AlbumInterface;
use App\Models\Album;
use App\Models\AlbumLanguage;
use App\Models\AlbumMedia;
use App\Models\Language;
use App\Models\Media;


class AlbumServices implements AlbumInterface
{
    private $album;

    public function __construct(Album $album)
    {
        $this->album = $album;
    }

    protected function save_media($request, $album_id)
    {
        foreach ($request['videos'] as $video) {

            if ($video != null) {
                if (str_contains($video, 'youtube.com/watch')) {
                    $video = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "//www.youtube.com/embed/$1", $video);
                }
                if (str_contains($video, '//vimeo.com')) {
                    $video = preg_replace('/vimeo.com/i', 'player.vimeo.com/video', $video);
                }
                $media = Media::create(['video' => $video]);
                AlbumMedia::create([
                    'media_id' => $media->id,
                    'album_id' => $album_id,
                ]);
            }
        }
        if (isset($request['images'])) {
            foreach ($request['images'] as $image) {
                if ($image != null) {
                    $image_name = $image->store('images', 'public');
                    $media = Media::create(['image' => $image_name]);
                    AlbumMedia::create([
                        'media_id' => $media->id,
                        'album_id' => $album_id,
                    ]);
                }
            }
        }

    }

    public function index()
    {
        $albums = $this->album->select('albums.id', 'album_languages.title', 'album_languages.description', 'is_active', 'created_at', 'updated_at')
            ->leftJoin('album_languages', function ($q) {
                $q->on('albums.id', 'album_languages.album_id')->where('album_languages.language_id', \auth()->user()->language_id);
            })->filter()->paginate();
        return $albums;
    }

    public function show($album_id)
    {
        $album = $this->album->select('albums.id', 'album_languages.title', 'album_languages.description', 'is_active', 'created_at', 'updated_at')
            ->leftJoin('album_languages', function ($q) {
                $q->on('albums.id', 'album_languages.album_id')->where('album_languages.language_id', \auth()->user()->language_id);
            })->findOrFail($album_id);
        return $album;
    }

    public function edit($album_id)
    {
        $album = $this->album->findOrFail($album_id);
        return $album;
    }

    public function store($request)
    {
        $albums = $request['albums'];
        $default_language = Language::where('is_default', 1)->first();
        $album_data = $this->album->create([
            'title' => $albums[$default_language->id]['title'],
            'description' => $albums[$default_language->id]['description'],
            'is_active' => isset($request['is_active'])?: 0
        ]);
        foreach ($albums as $key => $album) {
            AlbumLanguage::create([
                'language_id' => $key,
                'album_id' => $album_data->id,
                'title' => $album['title'],
                'description' => $album['description'],
            ]);
        }
        $this->save_media($request, $album_data->id);
        return true;
    }

    public function storeMedia($request, $album_id)
    {
        $this->save_media($request, $album_id);
        return true;
    }

    public function update($request, $album_id)
    {
        if (!isset($request['is_active'])) {
            $request['is_active'] = 0;
        }
        $album = $this->album->findOrFail($album_id);
        $albums_request = $request['albums'];
        $default_language = Language::where('is_default', 1)->first();
        $album->update([
            'title' => $albums_request[$default_language->id]['title'],
            'description' => $albums_request[$default_language->id]['description'],
            'is_active' => $request['is_active']
        ]);
        foreach ($albums_request as $key => $album_lang) {
            AlbumLanguage::updateOrCreate(
                [
                'language_id' => $key, 'album_id' => $album_id
                ],
                [
                    'title' => $album_lang['title'],
                    'description' => $album_lang['description'],
                ]);
        }
        return true;
    }

    public function destroy($album_id)
    {
        $this->album->findOrFail($album_id)->delete();
        return true;
    }

    public function destroyMedia($media_id)
    {
        Media::findOrFail($media_id)->delete();
        return true;
    }

}
