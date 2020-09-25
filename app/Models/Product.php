<?php

namespace App\Models;

use App\Traits\SlugMappingTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SlugMappingTrait;

    protected $table = 'products';

    protected $guarded = [
        'id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($item) {
            static::savedSlug($item);
        });

        static::updated(function ($item) {
            static::updatedSlug($item);
        });
    }
}
