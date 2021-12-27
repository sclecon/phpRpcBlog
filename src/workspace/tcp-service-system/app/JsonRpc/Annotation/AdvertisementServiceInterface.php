<?php


namespace App\JsonRpc\Annotation;


/**
 * 广告服务接口
 * @package App\JsonRpc\Annotation
 */
interface AdvertisementServiceInterface
{
    /**
     * 获取列表
     * @param int $number 获取几张banner
     * @param int $page 第几页
     * @return array
     */
    public function list(int $number = 10, int $page = 1) : array;

    /**
     * 获取数据
     * @param int $advertisementId 广告数据id
     * @return array
     */
    public function get(int $advertisementId) : array;

    /**
     * 添加数据
     * @param string $name 广告名称
     * @param string $image 广告图片
     * @param string $url 广告链接
     * @return int
     */
    public function add(string $name, string $image, string $url) : int;

    /**
     * 删除数据
     * @param int $advertisementId 广告数据id
     * @return bool
     */
    public function del(int $advertisementId) : bool;


    /**
     * 修改数据
     * @param array $data 新数据
     * @param array $condition 修改条件
     * @return bool
     */
    public function edit(array $data, array $condition) : bool;
}