<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeGroup extends Model
{
    protected $table = "product_attribute_groups";

    protected $guarded = ['id'];

    public function productAttributes()
    {
        return $this->belongsToMany(ProductAttribute::class, ProductAttributeGroupMapping::TABLE, 'product_attribute_id', 'product_attribute_group_id');
    }

    public function productCategories()
    {
        return $this->belongsToMany(ProductCategory::class, ProductAttributeGroupMapping::TABLE, 'product_category_id', 'product_attribute_group_id');
    }
}
