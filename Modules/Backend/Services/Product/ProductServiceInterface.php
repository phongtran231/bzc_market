<?php

namespace Modules\Backend\Services\Product;

use App\Models\Product;
use Modules\Backend\Services\BaseServiceInterface;

interface ProductServiceInterface extends BaseServiceInterface
{
    /**
     * @param array|string[] $select
     * @param bool $paginate
     * @param int $perPage
     * @return Product[]
     */
    public function index(array $select = ['*'], bool $paginate = true, int $perPage = 20);

    /**
     * @param int $id
     * @return Product|array
     */
    public function show(int $id);

    /**
     * @param array $attributes
     * @return Product|array
     */
    public function store(array $attributes);

    /**
     * @param array $attributes
     * @param int $id
     * @return Product|array
     */
    public function update(array $attributes, int $id);

    /**
     * @param int $id
     * @return bool|mixed
     */
    public function delete(int $id);
}
