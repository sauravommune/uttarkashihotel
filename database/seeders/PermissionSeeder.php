<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = [
            'Admin-Dashboard-View',
            'Hotel-Dashboard-View',
            'User-View',
            'User-Add',
            'User-Edit',
            'User-Delete',
            'Hotel-View',
            'Hotel-Add',
            'Hotel-Edit',
            'Hotel-Delete',
            'Rooms-View',
            'Rooms-Add',
            'Rooms-Edit',
            'Rooms-Delete',
            'Promotions-View',
            'Promotions-Add',
            'Promotions-Edit',
            'Promotions-Delete',
            'Manual-Booking-View',
            'Manual-Booking-Add',
            'Manual-Booking-Edit',
            'Manual-Booking-Delete',
            'Settings',
            'Lead-index',
            'Lead-view',
            'Lead-edit',
            'Lead-delete',
            'Role-view',
            'SEO-View',
            'SEO-Add',
            'SEO-delete',
            'Affiliate-View',
            'Affiliate-Add',
            'Affiliate-Edit',
            'Affiliate-Delete',
            'Payout-View',
            'Payout-Add',
            'Payout-Edit',
            'Payout-Delete',
            'Coupons-View',
            'Coupons-Add',
            'Coupons-Edit',
            'Coupons-Delete',
            'Client-Transaction-View',
            'Client-Transaction-Add',
            'Client-Transaction-Edit',
            'Client-Transaction-Delete',
            'Vendor-Transaction-View',
            'Vendor-Transaction-Add',
            'Vendor-Transaction-Edit',
            'Vendor-Transaction-Delete',
            'Youtube-Video',
        ];

        foreach ($permission as $value) {
            Permission::updateOrCreate(['name' => $value], ['name' => $value]);
        }

        // delete non existing permission
        Permission::whereNotIn('name', $permission)->delete();

    }
}
