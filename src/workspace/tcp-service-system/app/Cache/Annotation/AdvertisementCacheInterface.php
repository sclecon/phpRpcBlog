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

    /**
     * 清空广告列表
     * @param int $page 页码
     * @param int $limit 条数
     * @param bool $type 类型
     * @return bool
     */
    public function clearList(int $page, int $limit, $type = false) : bool ;
}