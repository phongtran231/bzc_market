<?php

namespace Modules\Backend\Services\CoreConfig;

use Modules\Backend\Services\BaseServiceInterface;

interface CoreConfigServiceInterface extends BaseServiceInterface
{
    /**
     * @param array $select
     * @param bool $paginate
     * @param int $perPage
     * @return mixed
     */
    public function getAllCoreConfig(array $select = ['*'], bool $paginate = true, int $perPage = 20);

    /**
     * @param int $id
     * @return mixed
     */
    public function getOneCoreConfig(int $id);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function storeCoreConfig(array $attributes);
}
