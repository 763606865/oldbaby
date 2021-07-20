<?php
namespace App\Services;

use App\Models\Platform;
use App\Models\PlatformStore;
use App\Models\StoreTags;

class PlatformService
{
    private static $instance;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function get()
    {
        $platforms = Platform::query()->get()->toArray();
        return $platforms;
    }

    public function binding(int $store_id=0, array $params=[])
    {
        $insert = [
            'store_id' => $store_id,
            'platform_id' => $params['platform_id'],
            'link' => $params['link'],
            'price'  => $params['price'],
            'origin_price'  => $params['origin_price'],
            'start_time'  => $params['start_time'],
            'end_time'  => $params['end_time'],
            'status'    => PlatformStore::STATUS_ON,
        ];
        PlatformStore::query()->insert($insert);
    }
}
