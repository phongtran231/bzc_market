<?php


namespace App\Repositories\ProductAttributeValue;


use App\Models\ProductAttributeValue;
use App\Repositories\BaseRepository;

class ProductAttributeValueRepository extends BaseRepository implements ProductAttributeValueRepositoryInterface
{

    public function model()
    {
        return ProductAttributeValue::class;
    }
}