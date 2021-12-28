<?php


namespace App\Utils\Annotation;
use \Closure;

interface CacheUtilsInterface
{
    /**
     * 获取缓存数据
     * @param string $key 缓存key
     * @param Closure $closure 获取不到缓存时进行数据获取
     * @param int $ttl 缓存时间
     * @return mixed
     */
    public function get(string $key, Closure $closure, int $ttl = 3600);
}