<?php

namespace Modules\Backend\Services\ProductAttribute;

use App\Repositories\ProductAttribute\ProductAttributeRepositoryInterface;
use App\Repositories\ProductAttributeGroup\ProductAttributeGroupRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Modules\Backend\Events\ProductAttribute\CreatedProductAttributeEvent;
use Modules\Backend\Events\ProductAttribute\UpdatedProductAttributeEvent;
use Modules\Backend\Services\BaseService;

class ProductAttributeService extends BaseService implements ProductAttributeServiceInterface
{

    /**
     * @var ProductAttributeRepositoryInterface
     */
    protected $_productAttributeRepository;

    /**
     * @var ProductAttributeGroupRepositoryInterface
     */
    protected $_productAttributeGroupRepository;

    /**
     * ProductAttributeService constructor.
     * @param ProductAttributeRepositoryInterface $productAttributeRepository
     * @param ProductAttributeGroupRepositoryInterface $productAttributeGroupRepository
     */
    public function __construct(
        ProductAttributeRepositoryInterface $productAttributeRepository,
        ProductAttributeGroupRepositoryInterface $productAttributeGroupRepository
    )
    {
        $this->_productAttributeRepository = $productAttributeRepository;
        $this->_productAttributeGroupRepository = $productAttributeGroupRepository;
    }

    protected function _setRelation(array $with = null)
    {
        $this->_productAttributeRepository = $this->_productAttributeRepository->with($with);
    }

    public function index(array $select = ['*'], bool $paginate = true, int $perPage = 20, array $with = null)
    {
        if ($with) {
            $this->_setRelation($with);
        }
        if ($paginate) {
            $response = $this->_productAttributeRepository->simplePaginate($perPage, $select);
        } else {
            $response = $this->_productAttributeRepository->all($select);
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

            DB::beginTransaction();
            $response = $this->_productAttributeRepository->create($attributes);
            DB::commit();
            if (isset($attributes['attribute_group_id'])) {
                $attributes['attribute_group_id'] = is_array($attributes['attribute_group_id']) ? $attributes['attribute_group_id'] : [$attributes['attribute_group_id']];
                foreach ($attributes['attribute_group_id'] as $groupId) {
                    if (!$this->_productAttributeGroupRepository->firstWhere(['id' => $groupId], ['id'])) {
                        return $this->_setResponseError("group {$groupId} không tồn tại")->_getResponseError();
                    }
                }
                event(new CreatedProductAttributeEvent($response, $attributes['attribute_group_id']));
            }
            return $this->_setResponseSuccess($response)->_getResponseSuccess();
        } catch (\Exception $e) {
            DB::rollBack();
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
            DB::beginTransaction();
            $response = $this->_productAttributeRepository->update($attributes, $id);
            DB::commit();
            if (isset($attributes['attribute_group_id'])) {
                $attributes['attribute_group_id'] = is_array($attributes['attribute_group_id']) ? $attributes['attribute_group_id'] : [$attributes['attribute_group_id']];
                foreach ($attributes['attribute_group_id'] as $groupId) {
                    if (!$this->_productAttributeGroupRepository->firstWhere(['id' => $groupId], ['id'])) {
                        return $this->_setResponseError("group {$groupId} không tồn tại")->_getResponseError();
                    }
                }
                event(new UpdatedProductAttributeEvent($response, $attributes['attribute_group_id']));
            }
            return $this->_setResponseSuccess($response)->_getResponseSuccess();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->_setResponseError($e->getTraceAsString())->_getResponseError();
        }
    }

    public function show(int $id, array $with = null)
    {

    }

    /**
     * @param int $id
     * @return array
     */
    public function destroy(int $id)
    {
        try {
            DB::beginTransaction();
            $this->_setResponseSuccess($this->_productAttributeRepository->delete($id))->_getResponseSuccess();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->_setResponseError($e->getTraceAsString())->_getResponseError();
        }
    }

    /**
     * @param $groupId
     * @param int $id
     * @return array
     */
    public function setGroup($groupId, int $id)
    {
        $groupId = is_array($groupId) ? $groupId : [$groupId];
        $response = $this->_productAttributeRepository->sync($id, 'productAttributeGroups', $groupId);
        return $this->_setResponseSuccess($response)->_getResponseSuccess();
    }
}
