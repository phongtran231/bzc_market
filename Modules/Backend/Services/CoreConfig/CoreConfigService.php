<?php

namespace Modules\Backend\Services\CoreConfig;

use App\Repositories\CoreConfig\CoreConfigRepositoryInterface;
use Modules\Backend\Services\BaseService;

class CoreConfigService extends BaseService implements CoreConfigServiceInterface
{
    public function __construct(
        CoreConfigRepositoryInterface $coreConfigRepository
    )
    {
    }
}
