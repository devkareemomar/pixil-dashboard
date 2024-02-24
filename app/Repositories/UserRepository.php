<?php

namespace App\Repositories;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRepository
{
    protected $relations = [];

    public function all()
    {
        return User::all();
    }

    public function paginate($perPage = null)
    {
        return User::paginate($perPage);
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function create(array $data)
    {
        $user = User::create($data);


        $role = Role::find($data['role_id']);
        if ($role) {
            $user->roles()->detach();
            $user->assignRole($role->name);
        }

        return $user;
    }

    public function update($id, array $data)
    {
        $user = $this->find($id);

        if ($data['password'] === null) {
            unset($data['password']);
        }

        $user->update(
            collect($data)->except($this->relations)->toArray()
        );

        $role = Role::find($data['role_id']);
        if ($role) {
            $user->roles()->detach();
            $user->assignRole($role->name);
        }

        return $user;

    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
