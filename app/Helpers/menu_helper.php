<?php

if (!function_exists('RoleIndividualMenus')) {

    if (!function_exists('RoleIndividualMenus')) {
        function RoleIndividualMenus()
        {
            // Define all menus
            $menus = array(
                
                array(
                    'title' => 'Dashboard',
                    'icon'  => 'grid_view',
                    'url'   => route('superAdmin.dashboard'),
                    'routes' => ['superAdmin.dashboard'],
                    'permission' => ['Admin-Dashboard-View'], // Add permission for each menu
                ),
                array(
                    'title' => 'Leads',
                    'icon'  => 'account_circle',
                    'url'   => route('lead.index'),
                    'routes' => ['lead.index'],
                    'permission' => ['Lead-index'], // Add permission for each menu
                ),
                // array(
                //     'title' => 'Booking Managent',
                //     'icon'  => 'view_compact_alt',
                //     'url'   => route('booking.index'),
                //     'routes' => ['booking.index'],
                //    'permission' => [],
                // ),
                // array(
                //     'title' => 'Manager Admin',
                //     'icon'  => 'view_compact_alt',
                //     'url'   => route('hotelmanager.dashboard'),
                //     'routes' => ['hotelmanager.dashboard', 'hotelmanager.details', 'hotelmanager.edit', 'hotelmanager.data'],
                //    'permission' => [],
                // ),
                // array(
                //     'title' => 'Hotel Report',
                //     'icon'  => 'area_chart',
                //     'url'   => route('hotel_report.index'),
                //     'routes' => ['hotel_report.index'],
                //    'permission' => [],
                // ),
                // array(
                //     'title' => 'Customer Review',
                //     'icon'  => 'area_chart',
                //     'url'   => route('customer-review.index'),
                //     'routes' => ['customer-review.index'],
                //    'permission' => [],
                // ),
                array(
                    'title' => 'Users',
                    'icon' => 'account_circle',
                    'url'   => route('users.index'),
                    'routes' => ['users.index', 'users.create', 'users.edit', 'roles.index', 'roles.create', 'roles.edit'],
                    'permission' => ['User-View'],
                ),
                array(
                    'title' => 'Hotels',
                    'icon' => 'hotel',
                    'url' => route('hotel'),
                    'routes' => ['hotel', 'hotel.add', 'hotel.view.details', 'room.add', 'rooms' , 'hotelmanager.add_room'],
                    'permission' => ['Hotel-View'],
                ),
                array(
                    'title' => 'External Hotels',
                    'icon' => 'hotel',
                    'url' => route('external.hotels'),
                    'routes' => ['external.hotels'],
                    'permission' => ['Hotel-View'],
                ),
                array(
                    'title' => 'Rate Plans',
                    'icon'  => 'currency_rupee',
                    'url'   => route('ratePlan.index'),
                    'routes' => ['ratePlan.index', 'ratePlan.create', 'ratePlans.add_margin'],
                    'permission' => ['Promotions-View'],
                ),
                array(
                    'title'         => 'Client Transactions',
                    'icon'          => 'receipt_long',
                    'url'           => route('transactions.index'),
                    'routes'        => ['transactions.index', 'transactions.add'],
                    'permission'    => ['Client-Transaction-View'],
                ),
                array(
                    'title'         => 'Vendor Transactions',
                    'icon'          => 'receipt_long',
                    'url'           => route('transactions.vendor'),
                    'routes'        => ['transactions.vendor'],
                    'permission'    => ['Vendor-Transaction-View'],
                ),
                array(
                    'title'         => 'Tax Calculator',
                    'icon'          => 'calculate',
                    'url'           => route('tax-calculator.index'),
                    'routes'        => ['tax-calculator.index'],
                    'permission'    => ['Vendor-Transaction-View'],
                ),
                // array(
                //     'title' => 'Coupons',
                //     'icon'  => 'editor_choice',
                //     'url'   => route('coupons.index'),
                //     'routes' => ['coupons.index','coupons.create'],
                //     'permission' => ['Coupons-View'],
                // ),
                array(
                    'title' => 'Room Settings',
                    'icon'  => 'tune',
                    'url'   => '#',
                    'routes'    => ['list.city','add.city','list.room_category','add.room_category','list.amenities','amenities.save','bedType','status.index','roles.index','roles.create','roles.edit','coupons.index','coupons.create','banks.index','banks.create','banks.edit'],
                    'permission' => ['settings'],
                    'submenus'  => array(
                        array(
                            'title' => 'City',
                            'icon'  => '',
                            'url'   => route('list.city'),
                            'routes' => ['list.city','add.city'],
                            'permission' => ['settings'],
                        ),

                        array(
                            'title' => 'Room Category',
                            'icon'  => '',
                            'url'   => route('list.room_category'),
                            'routes' => ['list.room_category','add.room_category'],
                            'permission' => ['settings'],
                        ),
                        array(
                            'title' => 'Amenities',
                            'icon' => '',
                            'url' => route('list.amenities'),
                            'routes' => ['list.amenities','amenities.save'],
                            'permission' => ['settings'],
                        ),
                        array(
                            'title' => 'Bed Type',
                            'icon'  => '',
                            'url'   => route('bedType'),
                            'routes' => ['bedType'],
                            'permission' => ['settings'],

                        ),
                        // array(
                        //     'title' => 'Status Master',
                        //     'icon'  => '',
                        //     'url'   => route('status.index'),
                        //     'routes' => ['status.index'],
                        //     'permission' => 'settings',
                        // ),
                        array(
                            'title' => 'Banks',
                            'icon'  => '',
                            'url'   => route('banks.index'),
                            'routes' => ['banks.index', 'banks.create', 'banks.edit'],
                            'permission' => ['Bank-view'],
                        ),
                    )
                ),
                array(
                    'title' => 'Settings',
                    'icon'  => 'settings',
                    'url'   => route('settings.index'),
                    'routes'    => ['settings.index','serverkey.index'],
                    'permission' => ['Settings'],
                ),
                array(
                    'title' => 'Search Queries',
                    'icon'  => 'search',
                    'url'   => route('lead.search'),
                    'routes'    => ['lead.search'],
                    'permission' => ['settings'],
                ),
                
                array(
                    'title' => 'Sitemap',
                    'icon' => 'account_tree',
                    'url' => route('site.map'),
                    'routes' => ['site.map'],
                    'permission' => [],
                 ),
                
                array(
                    'title' => 'Affiliate',
                    'icon'  => 'grid_view',
                    'url'   => route('referral.index'),
                    'routes' => ['referral.index','referral.register','referral.payouts','referral.reports'],
                    'permission' => ['Affiliate-View'], // Add permission for each menu
                ),
            );
            // return $menus;
            $user = auth()->user();
            $filteredMenu = array_filter($menus, function ($menuItem) use ($user) {
                return ($user->hasAnyPermission($menuItem['permission']) || $user->hasAnyRole(['Super Admin','Admin']));
            });
            return $filteredMenu;
        }
    }
}

