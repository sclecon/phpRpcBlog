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
        $advertisement = Advertisement::find($id);
        if ($advertisement){
            return $advertisement->toArray();
        }
        return [];
    }

    /**
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
        $advertisement->image = $image,
        $advertisement->name = $name,
        $advertisement->url = $url,
        $advertisement->ctype = $type;
        $advertisement->save();
        return $advertisement->id ?: 0;
    }

    public function edit(int $advertisementId, array $data): bool
    {
        return Advertisement::where('id', $advertisementId)->update($data);
    }

    public function del(int $advertisementId): bool
    {
        return Advertisement::where('id', $advertisementId)->delete();
    }

}