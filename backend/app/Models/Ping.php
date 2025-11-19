<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ping extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'uuid',
        'battery_percent',
        'created_at',
    ];
}
