<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformStore extends Model
{
    use HasFactory;

    const STATUS_OFF = 0;
    const STATUS_ON = 1;
}
