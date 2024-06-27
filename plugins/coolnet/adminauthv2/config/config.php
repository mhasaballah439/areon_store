<?php
 
return [ 
    'packages' => [ 
        'kreait/firebase-php' => [
            
            'config_namespace' => 'Firebasec',
            'config' => [
                'encoding'      => 'UTF-8',
                'finalize'      => true,
                'cachePath'     => storage_path('app/firebase'),
                'cacheFileMode' => 0755,
            ],
        ],
    ],
];