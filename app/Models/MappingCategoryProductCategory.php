<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MappingCategoryProductCategory extends Model
{
    protected $table = 'mapping_category_product_category';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}