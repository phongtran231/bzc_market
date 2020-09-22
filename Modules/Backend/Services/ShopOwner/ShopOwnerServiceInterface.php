<?php

namespace Modules\Backend\Services\ShopOwner;

use App\Models\ShopOwner;

interface ShopOwnerServiceInterface
{
    /**
     * @param array $attributes
     * @return mixed
     */
    public function store(array $attributes);

    /**
     * @return ShopOwner
     */
    public function getInfo();

}
