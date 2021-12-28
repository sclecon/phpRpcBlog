<?php

declare(strict_types=1);

return [
    'consumers' => [
        [
            'name'  =>  'AdvertisementService',
            'service'   =>  \App\JsonRpc\Annotation\AdvertisementServiceInterface::class,
            'protocol'  =>  'jsonrpc',
            'registry' => [
                'protocol' => 'consul',
                'address' => 'http://consul:8500',
            ]
        ]
    ]
];
