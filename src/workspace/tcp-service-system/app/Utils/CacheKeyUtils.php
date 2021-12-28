<?php


namespace App\Utils;


use App\Utils\Annotation\CacheKeyUtilsInterface;

class CacheKeyUtils implements CacheKeyUtilsInterface
{
    public function get($condition): string
    {
        if (is_array($condition)){
            $condition = unserialize($condition);
        }
        return substr(md5($condition), 8, 16);
    }
}