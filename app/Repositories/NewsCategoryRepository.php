<?php

namespace App\Repositories;

use App\Models\NewsCategory;

class NewsCategoryRepository
{
    public function all()
    {
        return NewsCategory::paginate();
    }

    public function query()
    {
        return NewsCategory::query();
    }

    public function find($id)
    {
        return NewsCategory::findOrFail($id);
    }

    public function create(array $data)
    {
        return NewsCategory::create($data);
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
