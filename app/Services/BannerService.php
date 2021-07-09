<?php
namespace App\Services;

use App\Models\Banner;

class BannerService
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
        $banners = Banner::query()
                    ->where('status',Banner::STATUS_USING)
                    ->get()->toArray();
        return $banners;
    }
}
