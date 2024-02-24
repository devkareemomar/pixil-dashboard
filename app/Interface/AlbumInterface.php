<?php

namespace App\Interface;

interface AlbumInterface
{
    public function index();

    public function store($request);

    public function show($album_id);

    public function storeMedia($request, $album_id);

    public function destroyMedia($media_id);

    public function edit($album_id);

    public function update($request, $album_id);

    public function destroy($album_id);

}
