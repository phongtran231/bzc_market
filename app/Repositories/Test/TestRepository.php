<?php

namespace App\Repositories\Test;

use App\Models\Test;
use App\Repositories\BaseRepository;

class TestRepository extends BaseRepository implements TestRepositoryInterface
{
    public function model()
    {
        return Test::class;
    }
}
