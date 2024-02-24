<?php

namespace App\Repositories;

use App\Models\Currency;

class CurrencyRepository
{
    public function all()
    {
        return Currency::paginate();
    }

    public function query()
    {
        return Currency::query();
    }

    public function find($id)
    {
        return Currency::findOrFail($id);
    }

    public function create(array $data)
    {
        return Currency::create($data);
    }

    public function update($id, array $data)
    {
        $currencies=$this->find($id);
        $currencies->update($data);
        return $currencies;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
