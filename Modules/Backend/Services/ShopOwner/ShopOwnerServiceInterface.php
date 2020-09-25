<?php

namespace Modules\Backend\Services\ShopOwner;

use App\Models\ShopOwner;
use Modules\Backend\Services\BaseServiceInterface;

interface ShopOwnerServiceInterface extends BaseServiceInterface
{

    /**
     * @return ShopOwner
     */
    public function getInfo();

    public function resetPassword(array $attributes, $shopOwner);

}
