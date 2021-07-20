<?php
namespace App\Services;

use App\Models\StoreTags;
use App\Models\Tag;

class TagService
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
        $tags = Tag::query()->get()->toArray();
        return $tags;
    }

    public function binding(int $store_id=0, array $tag_ids=[])
    {
        StoreTags::query()->where('store_id', $store_id)->delete();
        if(!empty($tag_ids))
        {
            foreach($tag_ids as $tag_id)
            {
                StoreTags::query()->insert([
                    'store_id'  => $store_id,
                    'tag_id'    => $tag_id
                ]);
            }
        }
    }
}
