<?php

namespace App\Repositories\ProductAttributeGroup;

use App\Models\ProductAttributeGroup;
use App\Repositories\BaseRepository;

class ProductAttributeGroupRepository extends BaseRepository implements ProductAttributeGroupRepositoryInterface
{
    public function model()
    {
        return ProductAttributeGroup::class;
    }
}
