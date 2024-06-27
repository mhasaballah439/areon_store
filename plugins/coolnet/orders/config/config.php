<?php
 
return [ 
    'packages' => [
        'strip/strip-php' => [
            
            'config_namespace' => 'Stripe',

            
            'config' => [
                'encoding'      => 'UTF-8',
                'finalize'      => true,
                'cachePath'     => storage_path('app/strip'),
                'cacheFileMode' => 0755,
            ],
        ],
    ],
];