<?php

namespace App\Repositories\CoreConfig;

use App\Models\CoreConfig;
use App\Repositories\BaseRepository;

class CoreConfigRepository extends BaseRepository implements CoreConfigRepositoryInterface
{
    public function model()
    {
        return CoreConfig::class;
    }
}
