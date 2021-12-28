<?php


namespace App\Utils\Annotation;


interface CacheKeyUtilsInterface
{
    /**
     * 获取缓存key
     * @param mixed $condition 条件
     * @return string
     */
    public function get($condition) : string;
}