<?php


namespace App\Cache;


use App\Cache\Annotation\AdvertisementCacheInterface;
use Hyperf\Cache\Listener\DeleteListenerEvent;
use Hyperf\Di\Annotation\Inject;
use Psr\EventDispatcher\EventDispatcherInterface;

class AdvertisementCache implements AdvertisementCacheInterface
{
    /**
     * @Inject
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    public function clearGet(int $id): bool
    {
        $this->dispatcher->dispatch(new DeleteListenerEvent('advertisement_get', ['id'=>$id]));
        return true;
    }
}