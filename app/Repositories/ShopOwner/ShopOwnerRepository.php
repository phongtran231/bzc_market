<?php

namespace App\Repositories\ShopOwner;

use App\Models\ShopOwner;
use App\Repositories\BaseRepository;

class ShopOwnerRepository extends BaseRepository implements ShopOwnerRepositoryInterface
{

    public function model()
    {
        return ShopOwner::class;
    }
}
