<?php


namespace App\Models;


use App\Traits\SlugMappingTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use SlugMappingTrait;
    protected $table = 'categories';

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