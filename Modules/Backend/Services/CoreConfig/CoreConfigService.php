<?php

namespace Modules\Backend\Services\CoreConfig;

use App\Repositories\CoreConfig\CoreConfigRepositoryInterface;
use Modules\Backend\Services\BaseService;

class CoreConfigService extends BaseService implements CoreConfigServiceInterface
{

    /**
     * @var CoreConfigRepositoryInterface
     */
    protected $_coreConfigRepository;

    /**
     * CoreConfigService constructor.
     * @param CoreConfigRepositoryInterface $coreConfigRepository
     */
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
    public function index(array $select = ['*'], bool $paginate = true, int $perPage = 20)
    {
        if ($paginate) {
            $data = $this->_coreConfigRepository->simplePaginate($perPage, $select);
        } else {
            $data = $this->_coreConfigRepository->all($select);
        }
        return $this->_setResponseSuccess($data)->_getResponseSuccess();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        return $this->_setResponseSuccess($this->_coreConfigRepository->find($id))->_getResponseSuccess();
    }

    /**
     * @param array $attributes
     * @return bool|mixed
     */
    public function store(array $attributes)
    {
        try {
            $this->_setResponseSuccess($this->_coreConfigRepository->create($attributes));
            return $this->_getResponseSuccess();
        } catch (\Exception $e) {
            return $this->_setResponseError($e->getMessage())->_getResponseError();
        }
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return bool|mixed
     */
    public function update(array $attributes, $id)
    {
        try {
            return $this->_setResponseSuccess($this->_coreConfigRepository->update($attributes, $id))->_getResponseSuccess();
        } catch (\Exception $e) {
            return $this->_setResponseError($e->getMessage())->_getResponseError();
        }
    }

    /**
     * @param int $id
     * @return int|mixed
     */
    public function destroy(int $id)
    {
        return $this->_setResponseSuccess($this->_coreConfigRepository->delete($id))->_getResponseSuccess();
    }
}
