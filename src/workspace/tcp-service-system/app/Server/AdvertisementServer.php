<?php


namespace App\Server;


use App\Cache\Annotation\AdvertisementCacheInterface;
use App\Model\Advertisement;
use App\Server\Annotation\AdvertisementServerInterface;
use Hyperf\Cache\Annotation\Cacheable;
use Hyperf\Cache\Annotation\CacheEvict;
use Hyperf\Di\Annotation\Inject;

class AdvertisementServer implements AdvertisementServerInterface
{
    /**
     * @Inject
     * @var AdvertisementCacheInterface
     */
    protected $cache;

    /**
     * @param int $advertisementId
     * @return array
     * @Cacheable(prefix="advertisement_get", ttl=3600, listener="advertisement_get", value="id_#{advertisementId}")
     */
    public function get(int $advertisementId): array
    {
        $advertisement = Advertisement::find($advertisementId);
        if ($advertisement){
            return $advertisement->toArray();
        }
        return [];
    }

    /**
     * @param int $page
     * @param int $limit
     * @param false $type
     * @return array
     * @Cacheable(prefix="advertisement_list", value="_#{page}_#{limit}_#{type}", ttl=3600, listener="advertisement_list")
     */
    public function list(int $page, int $limit = 10, $type = false): array
    {
        $advertisement = Advertisement::where(function($query) use ($type) {
            if (is_string($type)){
                $query->where('ctype', $type);
            }
        })->forPage($page, $limit)->get();
        if ($advertisement){
            return $advertisement->toArray();
        }
        return [];
    }


    public function add(string $image, string $name, string $url, string $type) : int
    {
        $advertisement = new Advertisement();
        $advertisement->image = $image;
        $advertisement->name = $name;
        $advertisement->url = $url;
        $advertisement->ctype = $type;
        $advertisement->save();
        return $advertisement->id ?: 0;
    }

    /**
     * @param int $advertisementId
     * @param array $data
     * @return bool
     * @CacheEvict(prefix="advertisement_get", value="id_#{advertisementId}")
     */
    public function edit(int $advertisementId, array $data): bool
    {
        return Advertisement::where('id', $advertisementId)->update($data);
    }

    /**
     * @param int $advertisementId
     * @return bool
     * @CacheEvict(prefix="advertisement_get", value="id_#{advertisementId}")
     */
    public function del(int $advertisementId): bool
    {
        return Advertisement::where('id', $advertisementId)->delete();
    }

}