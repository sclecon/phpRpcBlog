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

    /**
     * 添加广告
     * @param string $image 广告图片
     * @param string $name 广告名称
     * @param string $url 广告链接
     * @param string $type 广告类型
     * @return int
     */
    public function add(string $image, string $name, string $url, string $type) : int;

    /**
     * 修改广告
     * @param int $advertisementId
     * @param array $data
     * @return bool
     */
    public function edit(int $advertisementId, array $data) : bool ;

    /**
     * 删除广告
     * @param int $advertisementId
     * @return bool
     */
    public function del(int $advertisementId) : bool;
}