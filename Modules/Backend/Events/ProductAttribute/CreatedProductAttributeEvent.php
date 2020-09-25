<?php

namespace Modules\Backend\Events\ProductAttribute;

class CreatedProductAttributeEvent
{

    public $model;

    public $groupId;

    public function __construct($model, $groupId)
    {
        $this->model = $model;
        $this->groupId = $groupId;
    }
}
