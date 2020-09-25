<?php

namespace Modules\Backend\Services;

interface BaseServiceInterface
{
    public function index(array $select = ['*'], bool $paginate = true, int $perPage = 20, array $with = null);

    public function store(array $attributes);

    public function update(array $attributes, int $id);

    public function show(int $id, array $with = null);

    public function destroy(int $id);
}
