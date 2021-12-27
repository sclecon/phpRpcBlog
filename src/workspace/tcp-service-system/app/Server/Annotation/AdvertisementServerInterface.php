<?php


namespace App\Server\Annotation;


interface AdvertisementServerInterface
{
    /**
     * 获取广告数据
     * @param array $condition
     * @return array
     */
    public function get(array $condition) : array;
}