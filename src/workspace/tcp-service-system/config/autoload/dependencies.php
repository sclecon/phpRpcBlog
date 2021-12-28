<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    \App\Utils\Annotation\CacheUtilsInterface::class            =>  \App\Utils\CacheUtils::class,
    \App\Utils\Annotation\CacheKeyUtilsInterface::class         =>  \App\Utils\CacheKeyUtils::class,
    \App\Cache\Annotation\AdvertisementCacheInterface::class    =>  \App\Cache\AdvertisementCache::class,
    \App\Server\Annotation\AdvertisementServerInterface::class  =>  \App\Server\AdvertisementServer::class
];
