<?php

namespace App\Admin\Actions\Store;

use App\Models\StoreAlbum;
use App\Services\StoreService;
use Carbon\Carbon;
use Encore\Admin\Actions\RowAction;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Album extends RowAction
{
    public $name = '添加图集';

    public function handle(Model $model,Request $request)
    {
        // $model ...
        $thumbs = $request->file('thumbs');
        $store_id = $this->getKey();
        $albums = [];
        foreach($thumbs as $thumb)
        {
            $path = 'images/'.md5(uniqid()).'.'.$thumb->getClientOriginalExtension();
            $res = Storage::disk('oss')->put($path, @file_get_contents($thumb),'public');
            if($res) $albums[] = $path;
        }

        StoreService::getInstance()->albumBatch($store_id,$albums);

        return $this->response()->success('Success message.')->refresh();
    }

    public function form()
    {
        $this->multipleImage('thumbs','图集');
    }

}