<?php

namespace App\Admin\Actions\Store;

use App\Models\StoreTags;
use App\Services\TagService;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Tags extends RowAction
{
    public $name = '绑定tags';

    public function handle(Model $model, Request $request)
    {
        // $model ...
        $tag_id = $request->get('tag_id',[]);
        $store_id = $this->getKey();

        TagService::getInstance()->binding($store_id,$tag_id);

        return $this->response()->success('Success message.')->refresh();
    }

    public function form()
    {
        $store_id = $this->getKey();
        $tag_ids = StoreTags::query()->where('store_id', $store_id)->pluck('tag_id')->toArray();
        $tags = TagService::getInstance()->get();
        $tags = collect($tags)->pluck('name','id')->toArray();
        $this->multipleSelect('tag_id','绑定标签')->value($tag_ids)->options($tags);
    }

}