<?php


namespace App\JsonRpc;


use App\JsonRpc\Annotation\AdvertisementServiceInterface;
use Hyperf\RpcServer\Annotation\RpcService;

/**
 * @RpcService(name="AdvertisementServiceInterface", protocol="jsonrpc", server="jsonrpc", publishTo="consul")
 */
class AdvertisementService implements AdvertisementServiceInterface
{
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
        return [];
    }

    public function list(int $number = 10, int $page = 1): array
    {
        return [];
    }
}