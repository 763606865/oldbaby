<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    const STATUS_INIT = 0;
    const STATUS_USING = 1;
    const STATUS_PAUSE = 2;
    const STATUS_MAPS = [
        self::STATUS_INIT => '初始化',
        self::STATUS_USING => '使用中',
        self::STATUS_PAUSE => '暂停使用',
    ];
}
