<?php

namespace App\Services;

use App\Interface\NewsTagInterface;
use App\Models\NewsTag;

class NewsTagServices implements NewsTagInterface
{
    private $tag;

    public function __construct(NewsTag $tag)
    {
        $this->tag = $tag;
    }

    public function index()
    {
        $tags = $this->tag->paginate();
        return $tags;
    }

    public function edit($tag_id)
    {
        $tag = $this->tag->findOrFail($tag_id);
        return $tag;
    }

    public function store($request)
    {
        $this->tag->create($request);
        return true;
    }

    public function update($request, $tag_id)
    {
        $tag = $this->tag->findOrFail($tag_id);
        $tag->update($request);
        return true;
    }

    public function destroy($tag_id)
    {
        $this->tag->findOrFail($tag_id)->delete();
        return true;
    }

}
