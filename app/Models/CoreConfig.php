<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoreConfig extends Model
{
    protected $table = 'core_configs';

    protected $guarded = ['id'];

    public static function getCoreConfig(string $key)
    {
        return optional(static::where('key_config', $key)->first())->value;
    }
}
