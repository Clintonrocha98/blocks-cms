<?php

return [
    'blocks' => [
        'path' => app_path('Blocks'),
        'namespace' => 'App\\Blocks',
    ],

    'views' => [
        'path' => resource_path('views/components/blocks'),
    ],

    'stubs' => [
        'path' => resource_path('stubs/cms'),
        'package_path' => base_path('app-modules/cms/stubs'),
    ],
];
