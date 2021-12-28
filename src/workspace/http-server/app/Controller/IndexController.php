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

use App\JsonRpc\Annotation\AdvertisementServiceInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * @AutoController()
 */
class IndexController extends AbstractController
{
    /**
     * @Inject
     * @var AdvertisementServiceInterface
     */
    protected $advertisement;

    public function index()
    {
        $user = $this->request->input('user', 'Hyperfs');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
            'server'    =>  'http-server'
        ];
    }

    public function get(){
        $id = $this->request->input('id', 1);
        $data = $this->advertisement->get($id);
        return [
            'msg'   =>  'test',
            'code'  =>  200,
            'data'  =>  $data,
        ];
    }

    public function clear(){
        $data = $this->advertisement->list(10, 1);
        return [
            'msg'   =>  'test',
            'code'  =>  200,
            'data'  =>  $data,
        ];
    }
}
