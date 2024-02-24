<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    public function all()
    {
        return Permission::all();
    }

    public function find($id)
    {
        return Permission::findOrFail($id);
    }

    public function create(array $data)
    {
        return Permission::create($data);
    }

    public function update($id, array $data)
    {
        $permission = Permission::findOrFail($id);
        return $permission->update($data);
    }

    public function delete($id)
    {
        $permission = Permission::findOrFail($id);
        return $permission->delete();
    }
}
