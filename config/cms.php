<?php

declare(strict_types=1);

return [
    'blocks' => [
        'path' => app_path('Blocks'),
        'namespace' => 'App\\Blocks',
    ],

    'views' => [
        'path' => resource_path('views/components/blocks'),
        // View namespace/prefix used when resolving block views (dot notation)
        // e.g. 'components.blocks' for app views
        'namespace' => 'components.blocks',
    ],

    'stubs' => [
        'path' => resource_path('stubs/cms'),
        'package_path' => base_path('app-modules/cms/stubs'),
    ],
];
