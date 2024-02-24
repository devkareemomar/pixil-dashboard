<?php

namespace App\Repositories;

use App\Models\Language;

class LanguageRepository
{
    public function all()
    {
        return Language::paginate();
    }

    public function find($id)
    {
        return Language::findOrFail($id);
    }

    public function create(array $data)
    {
        return Language::create(
            collect($data)->except(['translation_file'])->toArray()
        );
    }

    public function update($id, array $data)
    {
        return $this->find($id)->update(
            collect($data)->except(['translation_file'])->toArray()
        );
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
