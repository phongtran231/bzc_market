<?php

namespace Modules\Backend\Services\ProductCategory;

use Modules\Backend\Services\BaseServiceInterface;

interface ProductCategoryServiceInterface extends BaseServiceInterface
{
    public function store(array $attributes);
}
