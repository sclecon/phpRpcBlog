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

    public function clearList(int $page, int $limit, $type = false): bool
    {
        return $this->clear(new DeleteListenerEvent('advertisement_list', ['page'=>$page, 'limit'=>$limit, 'type'=>$type]));
    }

    private function clear(DeleteListenerEvent $deleteListenerEvent){
        $this->dispatcher->dispatch($deleteListenerEvent);
        return true;
    }
}