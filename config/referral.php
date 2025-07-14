<?php

return [
    'referral_models' => 'App\Models\User',
    'lead_models' => 'App\Models\Booking',
    'referral_table' => 'users',
    'lead_table' => 'bookings',
    'referral_url' => 'https://cabsules.com?ref=',
    'lead_status' => [
        'new' => '1',
        'quotation_sent' => '2',
        'advance_received' => '3',
        'completed' => 'confirmed',
        'follow_up' => '5',
        'abandoned' => '6',
        'column' => 'status',
    ],
];