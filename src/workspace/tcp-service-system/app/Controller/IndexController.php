<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use App\Cache\Annotation\AdvertisementCacheInterface;
use App\Server\Annotation\AdvertisementServerInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Redis\Pool\PoolFactory;
use Hyperf\Redis\Redis;
use Hyperf\Utils\ApplicationContext;
use Psr\Container\ContainerInterface;

class IndexController extends AbstractController
{

    /**
     * @Inject
     * @var AdvertisementServerInterface
     */
    protected $advertisement;

    /**
     * @Inject
     * @var AdvertisementCacheInterface
     */
    protected $advertisementCache;

    /**
     * @Inject
     * @var ContainerInterface
     */
    protected $container;

    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();
        // $this->advertisement->edit(1, ['name'=>"新名字 ".date('y-d-d H:i:s', time())]);
        (new Redis(new PoolFactory($this->container)))->del('advertisement_get:*');
        $data = $this->advertisement->get(1);

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
            'data'  =>  $data,
        ];
    }
}
