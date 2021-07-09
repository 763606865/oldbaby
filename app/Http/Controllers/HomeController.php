<?php

namespace App\Http\Controllers;

use App\Services\BannerService;

class HomeController extends Controller
{
    public function index()
    {
        $banners = BannerService::getInstance()->get();

        return response()->json(['error' => false, 'data' => [
            'banners' => $banners,
        ]]);
    }
}
