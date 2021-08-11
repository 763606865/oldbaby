<?php

namespace App\Http\Controllers;

use App\Services\StoreService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->get('page',1);
        $perPage = $request->get('perPage', 20);
        $filter['name'] = $request->get('name', '');

        $stores = StoreService::getInstance()->paginate($page,$perPage);

        return response()->json(['error' => false, 'data' => [
            'stores' => $stores,
        ]]);
    }

    public function detail($store_id)
    {
        $store = StoreService::getInstance()->detail($store_id);

        return response()->json(['error' => false, 'data' => $store]);
    }
}
