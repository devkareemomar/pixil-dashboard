<?php

namespace App\Repositories;

use App\Models\Page;

class PageRepository
{
    public function all()
    {
        return Page::all();
    }

    public function find($id)
    {
        return Page::findOrFail($id);
    }

    public function create(array $data)
    {
        return Page::create($data);
    }

    public function update($id, array $data)
    {
        return $this->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
