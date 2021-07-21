<?php
namespace App\Services;

use App\Models\Store;
use App\Models\StoreTags;
use App\Models\Tag;

class StoreService
{
    private static $instance;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function paginate(int $page=1,int $perPage=20,array $filter=[],array $orders=[['id'=>'desc']])
    {
        $query = Store::query();

        if(!empty($filter['name']))
        {
            $query = $query->where('name','like', "%{$filter['name']}%");
        }
        foreach($orders as $order)
        {
            $query = $query->orderBy(array_keys($order)[0],array_values($order)[0]);
        }

        $paginate = $query->paginate($perPage, ['*'], 'page', $page);

        return $paginate;
    }

}
