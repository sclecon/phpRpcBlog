<?php


namespace App\Utils;


use App\Utils\Annotation\CacheUtilsInterface;
use Closure;
use Hyperf\Cache\Cache;
use Hyperf\Di\Annotation\Inject;

class CacheUtils implements CacheUtilsInterface
{
    /**
     * @Inject
     * @var Cache
     */
    protected $cache;

    public function get(string $key, Closure $closure, int $ttl = 3600)
    {
        if ($this->cache->has($key) === false){
            $this->cache->set($key, $closure(), $ttl);
        }
        return $this->cache->get($key);
    }
}