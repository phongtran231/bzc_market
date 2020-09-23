<?php

namespace Modules\Backend\Services\ShopOwner;

use App\Models\ShopOwner;
use Modules\Backend\Services\BaseServiceInterface;

interface ShopOwnerServiceInterface extends BaseServiceInterface
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

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id);

    public function resetPassword(array $attributes, $shopOwner);

}
