<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Supply Chain Tag Categories
    |--------------------------------------------------------------------------
    |
    | Define the available categories for supply chain tags. These categories
    | help organize and filter tags based on their purpose in the supply chain.
    |
    */
    'categories' => [
        'origin' => 'Product Origin',
        'processing' => 'Processing Steps',
        'transportation' => 'Transportation',
        'storage' => 'Storage Conditions',
        'quality' => 'Quality Control',
        'certification' => 'Certifications',
        'packaging' => 'Packaging Information',
        'customs' => 'Customs & Import/Export',
    ],

    /*
    |--------------------------------------------------------------------------
    | Verification Levels
    |--------------------------------------------------------------------------
    |
    | Define the available verification levels for supply chain tags and their
    | descriptions. These levels indicate the reliability of the tag information.
    |
    */
    'verification_levels' => [
        'pending' => 'Awaiting verification',
        'verified' => 'Verified by authorized personnel',
        'rejected' => 'Failed verification process',
    ],

    /*
    |--------------------------------------------------------------------------
    | Required Permissions
    |--------------------------------------------------------------------------
    |
    | Define the permissions required for different supply chain tag operations.
    | These permissions should be assigned to users through your role system.
    |
    */
    'permissions' => [
        'create_tags' => 'create_supply_chain_tags',
        'verify_tags' => 'verify_supply_chain_tags',
        'manage_tags' => 'manage_supply_chain_tags',
        'delete_tags' => 'delete_supply_chain_tags',
    ],

    /*
    |--------------------------------------------------------------------------
    | Metadata Schema
    |--------------------------------------------------------------------------
    |
    | Define the allowed metadata fields and their validation rules for
    | different tag categories.
    |
    */
    'metadata_schema' => [
        'origin' => [
            'location' => 'required|string',
            'producer' => 'required|string',
            'date' => 'required|date',
        ],
        'processing' => [
            'facility' => 'required|string',
            'process_type' => 'required|string',
            'temperature' => 'nullable|numeric',
            'duration' => 'nullable|string',
        ],
        'transportation' => [
            'carrier' => 'required|string',
            'vehicle_type' => 'required|string',
            'temperature_log' => 'nullable|array',
        ],
        'storage' => [
            'facility' => 'required|string',
            'temperature' => 'required|numeric',
            'humidity' => 'nullable|numeric',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Verification Requirements
    |--------------------------------------------------------------------------
    |
    | Define which tag categories require verification and the minimum role
    | level required to verify tags in each category.
    |
    */
    'verification_requirements' => [
        'origin' => ['required' => true, 'min_role' => 'supervisor'],
        'certification' => ['required' => true, 'min_role' => 'manager'],
        'quality' => ['required' => true, 'min_role' => 'quality_inspector'],
        'processing' => ['required' => false, 'min_role' => 'supervisor'],
        'transportation' => ['required' => false, 'min_role' => 'coordinator'],
        'storage' => ['required' => false, 'min_role' => 'coordinator'],
    ],
];