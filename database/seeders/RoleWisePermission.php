<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleWisePermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         
        //  $roles = Role::all();
        // foreach ($roles as $role) {
        //     // Assign permissions based on role
        //     switch ($role->name) {
        //         case 'Super Admin':
        //             // Admin has all permissions
        //             $role->syncPermissions(Permission::all());
        //             break;

        //         case 'Admin':
        //             // Editor can create, edit, and publish posts
        //             $role->syncPermissions(['rooms-create','hotel-dashboard',
        //     'rooms-edit',
        //     'rooms-list',
        //     'rooms-delete',  'manual-booking',
        //     'transactions',
        //     'create-invoices','promotions-create']);
        //             break;

        //         case 'Manager':
        //             // Author can only create and edit posts
        //             $role->syncPermissions(['rooms-create','hotel-dashboard',
        //     'rooms-edit',
        //     'rooms-list',
        //     'rooms-delete','manual-booking',
        //     'transactions',
        //     'create-invoices','promotions-create']);
        //             break;
        //         case 'Staff':
        //                 // Author can only create and edit posts
        //                 $role->syncPermissions(Permission::all());
        //                 break;
        //     }
        // }
    }
}
