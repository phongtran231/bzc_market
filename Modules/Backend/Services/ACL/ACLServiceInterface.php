<?php

namespace Modules\Backend\Services\ACL;

use Modules\Backend\Services\BaseServiceInterface;

interface ACLServiceInterface extends BaseServiceInterface
{
    /**
     * @param array $attributes
     * @return array
     */
    public function createRole(array $attributes): array;

    /**
     * @param array $attributes
     * @return array
     */
    public function createPermission(array $attributes): array;
}
