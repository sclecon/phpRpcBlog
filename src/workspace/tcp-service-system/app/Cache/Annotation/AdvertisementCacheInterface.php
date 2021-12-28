<?php


namespace App\Cache\Annotation;


interface AdvertisementCacheInterface
{
    /**
     * 清空广告数据
     * @param int $id 广告主键ID
     * @return bool
     */
    public function clearGet(int $id) : bool;
}