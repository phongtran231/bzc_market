<?php


namespace App\Repositories\SlugMapping;


use App\Models\SlugMapping;
use App\Repositories\BaseRepository;

class SlugMappingMappingRepository extends BaseRepository implements SlugMappingRepositoryInterface
{

    public function model()
    {
        return SlugMapping::class;
    }
}