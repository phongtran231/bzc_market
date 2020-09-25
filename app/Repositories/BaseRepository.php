<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository as AbstractRepository;

abstract class BaseRepository extends AbstractRepository implements BaseRepositoryInterface
{

    /**
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function firstWhere(array $where, array $columns = ['*'])
    {
        return $this->findWhere($where, $columns)->first();
    }
}
