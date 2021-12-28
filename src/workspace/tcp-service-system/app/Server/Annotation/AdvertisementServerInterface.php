<?php


namespace App\Server\Annotation;


interface AdvertisementServerInterface
{
    /**
     * 获取广告数据
     * @param int $id 主键ID
     * @return array
     */
    public function get(int $id) : array;

    /**
     * 获取数据列表
     * @param int $page 分页
     * @param int $limit 限制条数
     * @param false $type 广告类型
     * @return array
     */
    public function list(int $page, int $limit, $type = false) : array;
}