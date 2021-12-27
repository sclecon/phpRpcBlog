<?php


namespace App\Server;


use App\Model\Advertisement;
use App\Server\Annotation\AdvertisementServerInterface;
use Hyperf\Di\Annotation\Inject;
use Psr\SimpleCache\CacheInterface;

class AdvertisementServer implements AdvertisementServerInterface
{
    /**
     * @Inject
     * @var CacheInterface
     */
    protected $cache;

    /**
     * @param array $condition
     * @return array
     */
    public function get(array $condition): array
    {
        $cacheKey = substr(md5(serialize($condition)), 8, 16);
        if (!$this->cache->has($cacheKey)){
            $this->cache->set($cacheKey, Advertisement::get($condition)->toArray(), 3600);
        }
        return $this->cache->get($cacheKey);
    }
}