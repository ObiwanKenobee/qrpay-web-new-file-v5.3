<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Disaster Mode Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration file contains settings for the disaster mode feature
    | including emergency services allocations and mesh network parameters.
    |
    */

    'active' => env('DISASTER_MODE_ACTIVE', false),

    'emergency_data' => [
        'amount' => env('EMERGENCY_DATA_AMOUNT', '500MB'),
        'daily_limit' => env('EMERGENCY_DATA_DAILY_LIMIT', '100MB'),
        'total_allocation' => env('EMERGENCY_DATA_TOTAL', '2GB'),
    ],

    'emergency_sms' => [
        'amount' => env('EMERGENCY_SMS_AMOUNT', '50'),
        'daily_limit' => env('EMERGENCY_SMS_DAILY_LIMIT', '10'),
        'priority_numbers' => [
            'emergency' => '911',
            'police' => env('EMERGENCY_POLICE_NUMBER', ''),
            'ambulance' => env('EMERGENCY_AMBULANCE_NUMBER', ''),
            'fire' => env('EMERGENCY_FIRE_NUMBER', ''),
        ],
    ],

    'emergency_calls' => [
        'minutes' => env('EMERGENCY_CALL_MINUTES', '30'),
        'daily_limit' => env('EMERGENCY_CALL_DAILY_LIMIT', '10'),
        'max_duration' => env('EMERGENCY_CALL_MAX_DURATION', '5'), // minutes per call
    ],

    'mesh_network' => [
        'enabled' => env('MESH_NETWORK_ENABLED', true),
        'max_nodes' => env('MESH_NETWORK_MAX_NODES', 100),
        'signal_strength' => env('MESH_NETWORK_SIGNAL_STRENGTH', 'Good'),
        'connected_nodes' => env('MESH_NETWORK_CONNECTED_NODES', 0),
        'broadcast_interval' => env('MESH_NETWORK_BROADCAST_INTERVAL', 30), // seconds
    ],

    'notifications' => [
        'alert_levels' => [
            'info' => 0,
            'warning' => 1,
            'critical' => 2,
            'emergency' => 3,
        ],
        'channels' => [
            'sms' => true,
            'push' => true,
            'mesh' => true,
        ],
    ],

    'resources' => [
        'medical_facilities' => [],
        'emergency_shelters' => [],
        'water_stations' => [],
        'charging_stations' => [],
    ],
];