<?php


namespace App\Aspect;


use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;

class AdvertisementCacheListAspect extends AbstractAspect
{
    public $classes = [

    ];

    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        $response = $proceedingJoinPoint->process();
        // 在调用后进行某些处理
        return $response;
    }
}