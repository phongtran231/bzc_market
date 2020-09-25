<?php

namespace Modules\Backend\Services\ProductAttribute;

use Modules\Backend\Services\BaseServiceInterface;

interface ProductAttributeServiceInterface extends BaseServiceInterface
{
    public function setGroup($groupId, int $id);
}
