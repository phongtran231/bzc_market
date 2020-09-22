<?php

namespace App\Repositories\ProductAttribute;

use App\Models\ProductAttribute;
use App\Repositories\BaseRepository;
use App\Repositories\ProductCategory\ProductCategoryRepositoryInterface;

class ProductAttributeRepository extends BaseRepository implements ProductCategoryRepositoryInterface
{

    public function model()
    {
        return ProductAttribute::class;
    }
}
