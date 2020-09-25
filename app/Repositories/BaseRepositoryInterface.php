<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface BaseRepositoryInterface extends RepositoryInterface
{
    /**
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function firstWhere(array $where, array $columns = ['*']);

    /**
     * @param $column
     * @return $this
     */
    public function groupBy($column);
}
