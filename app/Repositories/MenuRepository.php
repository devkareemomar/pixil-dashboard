<?php

namespace App\Repositories;

use App\Models\Menu;

class MenuRepository
{
    protected $relations = ['items'];

    public function all()
    {
        return Menu::paginate();
    }

    public function paginate($perPage = null,)
    {
        return Menu::paginate($perPage);
    }

    public function find($id)
    {
        return Menu::findOrFail($id);
    }

    public function create(array $data)
    {
        $menu = Menu::create(
            collect($data)->except($this->relations)->toArray()
        );

        return $menu;
    }

    public function update($id, array $data)
    {
        $menu = $this->find($id);
        $menu->update(
            collect($data)->except($this->relations)->toArray()
        );
        return $menu;
    }

    public function delete($id)
    {
        $user = $this->find($id);
        return $user->delete();
    }
}
