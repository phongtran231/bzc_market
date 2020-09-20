<?php

namespace App\Traits;

use App\Models\SlugMapping;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

trait SlugMappingTrait
{
    public function slug(): HasOne
    {
        return $this->hasOne(SlugMapping::class);
    }

    protected static function savedSlug($item)
    {
        $slug = new SlugMapping(
            [
                'slug' => Str::slug($item->title),
                'object' => static::class,
                'object_id' => $item->id,
            ]
        );
        $item->slug()->save($slug);
    }
    
    protected static function updatedSlug($item)
    {
        $item->slug()->update(
            [
                'slug' => Str::slug($item->title),
            ]
        );
    }
}