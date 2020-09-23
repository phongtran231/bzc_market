<?php

namespace Modules\Backend\Services\CoreConfig;

use Modules\Backend\Services\BaseServiceInterface;

interface CoreConfigServiceInterface extends BaseServiceInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id);

    /**
     * @param array $attributes
     * @return mixed
     */
    public function store(array $attributes);

    /**
     * @param array $attributes
     * @param int $id
     * @return mixed
     */
    public function update(array $attributes, int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id);
}
