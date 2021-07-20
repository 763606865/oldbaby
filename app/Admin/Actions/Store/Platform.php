<?php

namespace App\Admin\Actions\Store;

use App\Models\PlatformStore;
use App\Services\PlatformService;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Platform extends RowAction
{
    public $name = '绑定平台';

    public function handle(Model $model, Request $request)
    {
        // $model ...
        $store_id = $this->getKey();

        $params = $request->all();
        $validator = validator($params,[
            'platform_id' => 'required',
            'link' => 'required',
            'price'  => 'required',
            'origin_price'  => 'required',
            'start_time'  => 'required',
            'end_time'  => 'required',
        ]);
        if($validator->fails()){
            return $this->response()->error($validator->getMessageBag())->refresh();
        }

        PlatformService::getInstance()->binding($store_id, $params);

        return $this->response()->success('Success message.')->refresh();
    }

    public function form()
    {
        $platforms = \App\Models\Platform::query()->pluck('name','id');
        $this->select('platform_id','绑定平台')->options($platforms);
        $this->text('link','链接');
        $this->text('price','价格');
        $this->text('origin_price','价值');
        $this->datetime('start_time','开始时间');
        $this->datetime('end_time','截止时间');
    }

}