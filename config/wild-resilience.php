<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Wild Resilience Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration file contains settings for the wild resilience feature
    | including dove dome parameters, resilience metrics, and system states.
    |
    */

    'dove_dome' => [
        'vegetables' => env('DOVE_DOME_VEGETABLES', '150'),
        'fish' => env('DOVE_DOME_FISH', '75'),
        'bee_hives' => env('DOVE_DOME_BEE_HIVES', '12'),
        'solar' => env('DOVE_DOME_SOLAR', '8.5kW'),
        'status' => env('DOVE_DOME_STATUS', 'operational'),
    ],

    'dove_dome_symbol' => [
        'live_feed' => env('DOVE_DOME_LIVE_FEED', 'All Systems Operational'),
        'learn_link' => env('DOVE_DOME_LEARN_LINK', '/learn-more'),
        'status_update' => env('DOVE_DOME_STATUS_UPDATE', 'Last updated: 1 hour ago'),
    ],

    'resilience_metrics' => [
        'food_security' => [
            'current' => env('RESILIENCE_FOOD_SECURITY', 85),
            'target' => 100,
            'unit' => '%',
        ],
        'water_security' => [
            'current' => env('RESILIENCE_WATER_SECURITY', 90),
            'target' => 100,
            'unit' => '%',
        ],
        'energy_security' => [
            'current' => env('RESILIENCE_ENERGY_SECURITY', 75),
            'target' => 100,
            'unit' => '%',
        ],
    ],

    'system_states' => [
        'monitoring' => true,
        'alerts_enabled' => true,
        'maintenance_mode' => false,
        'emergency_protocols' => false,
    ],

    'peace_gardens' => [
        'owls' => env('PEACE_GARDENS_OWLS', 2),
        'doves' => env('PEACE_GARDENS_DOVES', 15),
        'next_event' => env('PEACE_GARDENS_NEXT_EVENT', 'Tree planting (Oct 5)'),
        'status' => env('PEACE_GARDENS_STATUS', 'active'),
        'capacity' => env('PEACE_GARDENS_CAPACITY', 100),
        'current_visitors' => env('PEACE_GARDENS_CURRENT_VISITORS', 0),
        'upcoming_events' => [
            'planting' => env('PEACE_GARDENS_EVENT_PLANTING', true),
            'feeding' => env('PEACE_GARDENS_EVENT_FEEDING', true),
            'education' => env('PEACE_GARDENS_EVENT_EDUCATION', true),
        ],
    ],

    'therapy' => [
        'trees_planted' => env('THERAPY_TREES_PLANTED', 20),
        'doves_fed' => env('THERAPY_DOVES_FED', 5),
        'book_link' => env('THERAPY_BOOK_LINK', '#'),
        'sessions_completed' => env('THERAPY_SESSIONS_COMPLETED', 0),
        'active_programs' => [
            'nature_healing' => env('THERAPY_PROGRAM_NATURE', true),
            'animal_assisted' => env('THERAPY_PROGRAM_ANIMAL', true),
            'meditation' => env('THERAPY_PROGRAM_MEDITATION', true),
        ],
        'schedule' => [
            'morning' => env('THERAPY_SCHEDULE_MORNING', true),
            'afternoon' => env('THERAPY_SCHEDULE_AFTERNOON', true),
            'evening' => env('THERAPY_SCHEDULE_EVENING', false),
        ],
        'stats' => [
            'participants' => env('THERAPY_STATS_PARTICIPANTS', 0),
            'success_rate' => env('THERAPY_STATS_SUCCESS_RATE', '85%'),
            'satisfaction' => env('THERAPY_STATS_SATISFACTION', '4.8/5'),
        ],
    ],

    'guardian_network' => [
        'node_health' => env('GUARDIAN_NETWORK_HEALTH', 'Healthy'),
        'food_yield' => env('GUARDIAN_NETWORK_FOOD_YIELD', 30),
        'dashboard_link' => env('GUARDIAN_NETWORK_DASHBOARD', '#'),
        'active_nodes' => env('GUARDIAN_NETWORK_ACTIVE_NODES', 0),
        'total_nodes' => env('GUARDIAN_NETWORK_TOTAL_NODES', 0),
        'network_status' => [
            'uptime' => env('GUARDIAN_NETWORK_UPTIME', '99.9%'),
            'latency' => env('GUARDIAN_NETWORK_LATENCY', '45ms'),
            'bandwidth' => env('GUARDIAN_NETWORK_BANDWIDTH', '100Mbps'),
        ],
        'monitoring' => [
            'sensors_active' => env('GUARDIAN_NETWORK_SENSORS', true),
            'alerts_enabled' => env('GUARDIAN_NETWORK_ALERTS', true),
            'auto_healing' => env('GUARDIAN_NETWORK_AUTOHEALING', true),
        ],
        'resources' => [
            'cpu_usage' => env('GUARDIAN_NETWORK_CPU', '45%'),
            'memory_usage' => env('GUARDIAN_NETWORK_MEMORY', '60%'),
            'storage_usage' => env('GUARDIAN_NETWORK_STORAGE', '55%'),
        ],
    ],

    'impact_wallet' => [
        'balance' => env('IMPACT_WALLET_BALANCE', 2500),
        'currency' => env('IMPACT_WALLET_CURRENCY', 'KSh'),
        'recent_aid' => [
            [
                'type' => env('IMPACT_WALLET_AID_TYPE_1', 'Food Credit'),
                'amount' => env('IMPACT_WALLET_AID_AMOUNT_1', 1000),
                'date' => env('IMPACT_WALLET_AID_DATE_1', date('Y-m-d', strtotime('-1 day'))),
            ],
            [
                'type' => env('IMPACT_WALLET_AID_TYPE_2', 'Water Credit'),
                'amount' => env('IMPACT_WALLET_AID_AMOUNT_2', 500),
                'date' => env('IMPACT_WALLET_AID_DATE_2', date('Y-m-d', strtotime('-2 days'))),
            ],
            [
                'type' => env('IMPACT_WALLET_AID_TYPE_3', 'Tuition Credit'),
                'amount' => env('IMPACT_WALLET_AID_AMOUNT_3', 1000),
                'date' => env('IMPACT_WALLET_AID_DATE_3', date('Y-m-d', strtotime('-3 days'))),
            ],
        ],
        'settings' => [
            'auto_distribute' => env('IMPACT_WALLET_AUTO_DISTRIBUTE', true),
            'minimum_balance' => env('IMPACT_WALLET_MIN_BALANCE', 1000),
            'daily_limit' => env('IMPACT_WALLET_DAILY_LIMIT', 5000),
        ],
        'impact_metrics' => [
            'lives_impacted' => env('IMPACT_WALLET_LIVES_IMPACTED', 0),
            'communities_served' => env('IMPACT_WALLET_COMMUNITIES', 0),
            'total_aid_distributed' => env('IMPACT_WALLET_TOTAL_AID', 0),
        ],
    ],
];