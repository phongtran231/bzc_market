<?php

namespace App\Traits;

use App\Models\SlugMapping;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

trait SlugMappingTrait
{
    public function slug(): HasOne
    {
        return $this->hasOne(SlugMapping::class, 'object_id' ,'id');
    }

    protected static function savedSlug($item)
    {
        $data = [
            'object' => static::class,
            'object_id' => $item->id,
        ];
        $slug = SlugMapping::where($data)->first();
        if (!$slug) {
            $slug = new SlugMapping(array_merge($data, ['slug' => Str::slug($item->title)]));
            $item->slug()->save($slug);
        } else {
            $slug->slug = Str::slug($item->title);
            $slug->save();
        }
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
