<?php

namespace App\Http\Controllers;

use App\Helpers\DeleteRow;
use App\Http\Requests\AlbumRequest;
use App\Interface\AlbumInterface;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    private $album;

    public function __construct(AlbumInterface $album)
    {
        $this->album = $album;

        $this->middleware('permission:album-read|album-create|album-update|album-delete', ['only' => ['index']]);
        $this->middleware('permission:album-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:album-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:album-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $results = $this->album->index();
        return view('albums.index', compact('results'));
    }

    public function create()
    {
        return view('albums.create');

    }

    public function show($album_id)
    {
        $result = $this->album->show($album_id);
        return view('albums.show', compact('result'));
    }

    public function store(AlbumRequest $request)
    {
        $data = $request->validated();
        $this->album->store($data);
        return redirect()->route('albums.index')->with('success', __('album created successfully.'));
    }

    public function storeMedia(AlbumRequest $request, $album_id)
    {
        $data = $request->validated();
        $this->album->storeMedia($data, $album_id);
        return back()->with('success',  __('album created successfully.'));
    }

    public function edit($album_id)
    {
        $result = $this->album->edit($album_id);
        return view('albums.edit', compact('result'));
    }

    public function update(AlbumRequest $request, $album_id)
    {
        $data = $request->validated();
        $this->album->update($data, $album_id);
        return redirect()->route('albums.index')->with('success',  __('album updated successfully.'));
    }

    public function destroyMedia($media_id)
    {
        $this->album->destroyMedia($media_id);
        return back()->with('success',  __('media deleted successfully.'));
    }

    public function destroy($album_id)
    {
        $this->album->destroy($album_id);
        return back()->with('success',  __('album deleted successfully.'));
    }
    public function deleteSelectRow(Request $request)
    {
        $selectedRows=$request->input('selectedRows');
        if ($selectedRows==null)
        {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(Album::class,$selectedRows);
        return back()->with('success',  __('album deleted successfully.'));

    }
}
