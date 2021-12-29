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

    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();
        $data = $this->advertisement->list(1, 10, false);

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
            'data'  =>  $data,
        ];
    }
}
