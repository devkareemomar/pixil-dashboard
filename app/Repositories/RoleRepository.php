<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepository
{
    protected $relations = ['permissions'];

    public function all()
    {
        return Role::paginate();
    }

    public function paginate($perPage = null)
    {
        return Role::paginate($perPage);
    }

    public function find($id)
    {
        return Role::findOrFail($id);
    }

    public function create(array $data)
    {
        $role = Role::create(
            collect($data)->except($this->relations)->toArray()
        );

        if(isset($data['permissions'])){
            $role->syncPermissions($data['permissions']);
        }else{
            $role->syncPermissions([]);
        }

        return $role;
    }

    public function update($id, array $data)
    {
        $role = $this->find($id);
        $role->update(
            collect($data)->except($this->relations)->toArray()
        );

        if(isset($data['permissions'])){
            $role->syncPermissions($data['permissions']);
        }else{
            $role->syncPermissions([]);
        }

        return $role;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
