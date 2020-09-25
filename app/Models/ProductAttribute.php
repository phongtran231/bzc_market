<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $table = 'product_attributes';

    protected $guarded = [
        'id'
    ];

    public function productAttributeGroups()
    {
        return $this->belongsToMany(ProductAttributeGroup::class, ProductAttributeGroupMapping::TABLE, 'product_attribute_id', 'product_attribute_group_id');
    }
}
