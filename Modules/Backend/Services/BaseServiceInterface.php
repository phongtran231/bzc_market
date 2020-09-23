<?php

namespace Modules\Backend\Services;

interface BaseServiceInterface
{
    public function index(array $select = ['*'], bool $paginate = true, int $perPage = 20);
}
