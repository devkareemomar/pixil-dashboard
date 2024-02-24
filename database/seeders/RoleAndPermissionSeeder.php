<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'tag',
            'user',
            'role',
            'language',
            'country',
            'currency',
            'category',
            'project',
            'link',
            'career',
            'help list',
            'help type',
            'menu',
            'slider',
            'news',
            'news category',
            'news tag',
            'campaign',
            'project status',
            'album',
            'cart',
            'division',
            'notification',
            'page',
            'transaction',
            'site pages',
            'form builder',
            'form builder data',
            'payment gateway',
            'social media',
        ];
        $actions = ['read', 'create', 'update', 'delete'];

        $more_permissions = [
            'contact us-read',
            'settings-update',
            'visit-read',
            'audit-read',
            'donation-read',
            'gift-read'
        ];

        $permissions = [
            ...$this->generate_permission_combinations($roles, $actions),
            ...$more_permissions
        ];


        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }
        $superAdminRole = Role::updateOrCreate(['name' => 'super-admin']);
        $customer = Role::updateOrCreate(['name' => 'customer']);

        $allPermissions = Permission::pluck('id')->toArray();
        $superAdminRole->syncPermissions($allPermissions);
    }

    private function generate_permission_combinations($roles, $actions)
    {
        $permission_combinations = array();

        foreach ($roles as $role) {
            foreach ($actions as $action) {
                $permission = $role . '-' . $action;
                array_push($permission_combinations, $permission);
            }
        }

        return $permission_combinations;
    }


}
