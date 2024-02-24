<?php

namespace App\Repositories;

use App\Models\Country;

class CountryRepository
{
    public function all()
    {
        return Country::all();
    }

    public function paginate($perPage = null)
    {
        return Country::paginate($perPage);
    }

    public function query()
    {
        return Country::query();
    }

    public function find($id)
    {
        return Country::findOrFail($id);
    }

    public function create(array $data)
    {
        return Country::create($data);
    }

    public function update($id, array $data)
    {
        $country = $this->find($id);
        $country->update($data);
        return $country;

    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
