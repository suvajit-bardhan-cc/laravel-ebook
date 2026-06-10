<?php

namespace App\Helpers;

use App\Models\Permission;

class PermissionHelper
{
    public static function getModules()
    {
        return [
            'dashboard' => 'Dashboard',
            'users' => 'User Management',
            'books' => 'Book Management',
            'categories' => 'Category Management',
            'roles' => 'Role Management',
        ];
    }

    public static function getPermissionsByModule()
    {
        $permissions = Permission::all();
        $grouped = [];

        foreach ($permissions as $permission) {
            if (!isset($grouped[$permission->module])) {
                $grouped[$permission->module] = [];
            }
            $grouped[$permission->module][] = $permission;
        }

        return $grouped;
    }
}