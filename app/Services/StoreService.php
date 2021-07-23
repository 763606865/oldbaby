<?php
namespace App\Services;

use App\Models\Platform;
use App\Models\PlatformStore;
use App\Models\Store;
use App\Models\StoreAlbum;
use App\Models\StoreTags;
use App\Models\Tag;
use Carbon\Carbon;

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

        $paginate = $query->paginate($perPage, ['*'], 'page', $page)->toArray();

        $paginate['data'] = collect($paginate['data'])->map(function ($item){
            $tag_ids = StoreTags::query()->where('store_id',$item['id'])->pluck('tag_id');
            $tags = [];
            foreach($tag_ids as $tag_id)
            {
                $tags[] = Tag::query()->where('id',$tag_id)->first()->toArray();
            }
            $item['tags'] = $tags;
            return $item;
        })->toArray();

        return $paginate;
    }

    public function albumBatch(int $store_id,array $albums=[])
    {
        if(!empty($albums))
        {
            $inserts = [];
            collect($albums)->each(function($album) use($store_id,&$inserts){
                $inserts[] = [
                    'store_id' => $store_id,
                    'thumb' => $album,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ];
            });
            StoreAlbum::query()->insert($inserts);
        }
    }

    public function detail(int $store_id)
    {

        $info = Store::query()->where('id',$store_id)->first()->toArray();

        $platforms = PlatformStore::query()->where('store_id',$store_id)->get()->map(function ($item){
            $platform = Platform::query()->where('id',$item->platform_id)->first();
            $item['platform_name'] = $platform->name;
            $item['platform_mark'] = $platform->mark;
            return $item;
        })->toArray();

        $albums = StoreAlbum::query()->where('store_id', $store_id)->get()->toArray();

        $data = [
            'info'      => $info,
            'platforms' => $platforms,
            'albums'    => $albums,
        ];
        return $data;
    }
}
