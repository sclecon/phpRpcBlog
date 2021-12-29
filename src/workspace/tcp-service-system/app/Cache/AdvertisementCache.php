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
        var_dump('清空单项缓存');
        return $this->clear(new DeleteListenerEvent('advertisement_get', ['id'=>$id]));
    }

    public function clearList(int $page, int $limit, $type = false): bool
    {
        var_dump('清空列表缓存');
        return $this->clear(new DeleteListenerEvent('advertisement_list', ['page'=>$page, 'limit'=>$limit, 'type'=>$type]));
    }

    private function clear(DeleteListenerEvent $deleteListenerEvent){
        $this->dispatcher->dispatch($deleteListenerEvent);
        return true;
    }
}