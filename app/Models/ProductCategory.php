<?php

namespace App\Models;

use App\Traits\SlugMappingTrait;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use SlugMappingTrait;

    protected $table = 'product_categories';

    protected $guarded = [
        'id'
    ];

    public function productAttributeGroups()
    {
        return $this->belongsToMany(ProductAttributeGroup::class, ProductAttributeGroupMapping::TABLE, 'product_category_id', 'product_attribute_group_id');
    }

    protected static function boot()
    {
        static::saved(function ($item) {
            static::savedSlug($item);
        });

        static::updated(function ($item) {
            static::updatedSlug($item);
        });

        parent::boot();
    }
}
