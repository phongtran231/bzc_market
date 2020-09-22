<?php

namespace Modules\Backend\Services\CoreConfig;

use App\Repositories\CoreConfig\CoreConfigRepositoryInterface;
use Modules\Backend\Services\BaseService;

class CoreConfigService extends BaseService implements CoreConfigServiceInterface
{

    protected $_coreConfigRepository;

    public function __construct(
        CoreConfigRepositoryInterface $coreConfigRepository
    )
    {
        $this->_coreConfigRepository = $coreConfigRepository;
    }

    /**
     * @param array $select
     * @param bool $paginate
     * @param int $perPage
     * @return mixed
     */
    public function getAllCoreConfig(array $select = ['*'], bool $paginate = true, int $perPage = 20)
    {
        if ($paginate) {
            return $this->_coreConfigRepository->simplePaginate($paginate, $select);
        }

        return $this->_coreConfigRepository->all($select);
    }

    public function getOneCoreConfig(int $id)
    {
        return $this->_coreConfigRepository->find($id);
    }

    public function storeCoreConfig(array $attributes)
    {

    }
}
