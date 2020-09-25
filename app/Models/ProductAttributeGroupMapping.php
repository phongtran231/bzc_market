<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeGroupMapping extends Model
{
    const TABLE = 'product_attribute_group_mappings';

    protected $table = "product_attribute_group_mappings";

    public $timestamps = false;

    protected $primaryKey = null;

    public $incrementing = false;

    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id', 'id');
    }

    public function productAttributeGroup()
    {
        return $this->belongsTo(ProductAttributeGroup::class, 'product_attribute_group_id', 'id');
    }
}
