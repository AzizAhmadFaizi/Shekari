<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'organization_logos' => [
            'driver' => 'local',
            'root' => storage_path('app/public/organization_logos'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'president_images' => [
            'driver' => 'local',
            'root' => storage_path('app/public/president_images'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'contract_attachments' => [
            'driver' => 'local',
            'root' => storage_path('app/public/contract_attachments'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'employee_attachments' => [
            'driver' => 'local',
            'root' => storage_path('app/public/employee_attachments'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'weapon_attachments' => [
            'driver' => 'local',
            'root' => storage_path('app/public/weapon_attachments'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'employee_payment_attachments' => [
            'driver' => 'local',
            'root' => storage_path('app/public/employee_payment_attachments'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'employee_status_attachments' => [
            'driver' => 'local',
            'root' => storage_path('app/public/employee_status_attachments'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'weapon_payment_attachments' => [
            'driver' => 'local',
            'root' => storage_path('app/public/weapon_payment_attachments'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'vice_president_images' => [
            'driver' => 'local',
            'root' => storage_path('app/public/vice_president_images'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'president_attachments' => [
            'driver' => 'local',
            'root' => storage_path('app/public/president_attachments'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'vice_president_attachments' => [
            'driver' => 'local',
            'root' => storage_path('app/public/vice_president_attachments'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'attachment_files' => [
            'driver' => 'local',
            'root' => storage_path('app/public/attachment_files'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'vehicle_attachment_files' => [
            'driver' => 'local',
            'root' => storage_path('app/public/vehicle_attachment_files'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'weapon_attachment_files' => [
            'driver' => 'local',
            'root' => storage_path('app/public/weapon_attachment_files'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
