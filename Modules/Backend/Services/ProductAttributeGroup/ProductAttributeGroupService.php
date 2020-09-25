<?php

namespace Modules\Backend\Services\ProductAttributeGroup;

use App\Repositories\ProductAttributeGroup\ProductAttributeGroupRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Modules\Backend\Services\BaseService;

class ProductAttributeGroupService extends BaseService implements ProductAttributeGroupServiceInterface
{
    /**
     * @var ProductAttributeGroupRepositoryInterface
     */
    protected $_productAttributeGroupRepository;

    /**
     * ProductAttributeGroupService constructor.
     * @param ProductAttributeGroupRepositoryInterface $productAttributeGroupRepository
     */
    public function __construct(
        ProductAttributeGroupRepositoryInterface $productAttributeGroupRepository
    )
    {
        $this->_productAttributeGroupRepository = $productAttributeGroupRepository;
    }

    /**
     * @param array|null $with
     */
    protected function _setRelation(array $with = null)
    {
        $this->_productAttributeGroupRepository = $this->_productAttributeGroupRepository->with($with);
    }

    public function index(array $select = ['*'], bool $paginate = true, int $perPage = 20, array $with = null)
    {
        if ($with) {
            $this->_setRelation($with);
        }
        if ($paginate) {
            $response = $this->_productAttributeGroupRepository->simplePaginate($perPage, $select);
        } else {
            $response = $this->_productAttributeGroupRepository->all($select);
        }
        return $this->_setResponseSuccess($response)->_getResponseSuccess();
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function store(array $attributes)
    {
        try {
            return $this->_setResponseSuccess($this->_productAttributeGroupRepository->create($attributes))->_getResponseSuccess();
        } catch (\Exception $e) {
            return $this->_setResponseError($e->getTraceAsString())->_getResponseError();
        }
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return array
     */
    public function update(array $attributes, int $id)
    {
        try {
            return $this->_setResponseSuccess($this->_productAttributeGroupRepository->update($attributes, $id))->_getResponseSuccess();
        } catch (\Exception $e ) {
            return $this->_setResponseError($e->getTraceAsString())->_getResponseError();
        }
    }

    /**
     * @param int $id
     * @param array|null $with
     * @return array
     */
    public function show(int $id, array $with = null)
    {
        if ($with) {
            $this->_setRelation($with);
        }
        return $this->_setResponseSuccess($this->_productAttributeGroupRepository->find($id))->_getResponseSuccess();
    }

    /**
     * @param int $id
     * @return array
     */
    public function destroy(int $id)
    {
        try {
            DB::beginTransaction();
            $response = $this->_productAttributeGroupRepository->delete($id);
            DB::commit();
            return $this->_setResponseSuccess($response)->_getResponseSuccess();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->_setResponseError($e->getTraceAsString())->_getResponseError();
        }
    }
}
