<?php

/**
 * Created By PhpStorm
 * User sclecon
 * Contact Email 27941662@qq.com
 * Time 2021/12/27 10:21
 */


namespace App\JsonRpc\Annotation;


/**
 * 获取广告数据
 * Interface AdvertisementServiceInterface
 */
interface AdvertisementServiceInterface
{
    /**
     * 获取轮播图
     * @param int $number 获取数量
     * @return array
     */
    public function getBanner(int $number = 3) : array;
}