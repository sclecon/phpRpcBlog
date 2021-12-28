<?php


namespace App\Server;


use App\Model\Advertisement;
use App\Server\Annotation\AdvertisementServerInterface;
use App\Utils\Annotation\CacheKeyUtilsInterface;
use App\Utils\Annotation\CacheUtilsInterface;
use Hyperf\Di\Annotation\Inject;

class AdvertisementServer implements AdvertisementServerInterface
{
    /**
     * @Inject
     * @var CacheUtilsInterface
     */
    protected $cache;

    /**
     * @Inject
     * @var CacheKeyUtilsInterface
     */
    protected $cacheKye;

    /**
     * @param array $condition
     * @return array
     */
    public function get(array $condition): array
    {
        $this->cache->get($this->cacheKye->get($condition), function() use ($condition) {
            return Advertisement::get($condition)->toArray();
        }, 60);
    }
}