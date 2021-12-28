<?php


namespace App\Server;


use App\Cache\Annotation\AdvertisementCacheInterface;
use App\Model\Advertisement;
use App\Server\Annotation\AdvertisementServerInterface;
use Hyperf\Cache\Annotation\Cacheable;
use Hyperf\Di\Annotation\Inject;

class AdvertisementServer implements AdvertisementServerInterface
{
    /**
     * @Inject
     * @var AdvertisementCacheInterface
     */
    protected $cache;

    /**
     * @Cacheable(prefix="advertisement_get", ttl=3600, listener="advertisement_get")
     */
    public function get(int $id): array
    {
        var_dump('从数据库查询');
        $advertisement = Advertisement::find($id);
        if ($advertisement){
            return $advertisement->toArray();
        }
        return [];
    }

    public function list(int $page, int $limit, $type = false): array
    {
        var_dump('清空Redis缓存');
        $this->cache->clearGet(1);
        return [];
    }
}