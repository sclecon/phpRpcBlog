<?php


namespace App\JsonRpc;


use App\JsonRpc\Annotation\AdvertisementServiceInterface;
use App\Server\Annotation\AdvertisementServerInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\RpcServer\Annotation\RpcService;

/**
 * @RpcService(name="AdvertisementService", protocol="jsonrpc", server="jsonrpc", publishTo="consul")
 */
class AdvertisementService implements AdvertisementServiceInterface
{
    /**
     * @Inject
     * @var AdvertisementServerInterface
     */
    protected $server;

    public function add(string $name, string $image, string $url): int
    {
        return 1;
    }

    public function del(int $advertisementId): bool
    {
        return true;
    }

    public function edit(array $data, array $condition): bool
    {
        return true;
    }

    public function get(int $advertisementId): array
    {
        return $this->server->get($advertisementId);
    }

    public function list(int $number = 10, int $page = 1): array
    {
        return $this->server->list($page, $number, 'banner');
    }
}