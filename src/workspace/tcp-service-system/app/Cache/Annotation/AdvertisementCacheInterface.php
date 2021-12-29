<?php


namespace App\Cache\Annotation;


interface AdvertisementCacheInterface
{
    /**
     * 清空广告列表
     * @param int $page 页码
     * @param int $limit 条数
     * @param bool $type 类型
     * @return bool
     */
    public function clearList(int $page, int $limit, $type = false) : bool ;
}