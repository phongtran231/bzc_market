<?php

namespace Modules\Backend\Events\ShopOwner;

use App\Models\ShopOwner;

class CreatedShopOwnerEvent
{
    /**
     * @var ShopOwner
     */
    public $model;

    public function __construct($model)
    {
        $this->model = $model;
    }
}
