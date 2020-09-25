<?php

namespace Modules\Backend\Services\ProductCategory;

use App\Repositories\ProductCategory\ProductCategoryRepositoryInterface;
use Modules\Backend\Services\BaseService;

class ProductCategoryService extends BaseService implements ProductCategoryServiceInterface
{

    /**
     * @var ProductCategoryRepositoryInterface
     */
    protected $_productCategoryRepository;

    /**
     * ProductCategoryService constructor.
     * @param ProductCategoryRepositoryInterface $productCategoryRepository
     */
    public function __construct(
        ProductCategoryRepositoryInterface $productCategoryRepository
    )
    {
        $this->_productCategoryRepository = $productCategoryRepository;
    }

    /**
     * @param array $select
     * @param bool $paginate
     * @param int $perPage
     * @param array $with
     * @return array
     */
    public function index(array $select = ['*'], bool $paginate = true, int $perPage = 20, array $with = null)
    {
        if ($with) {
            $this->_setRelation($with);
        }
        if ($paginate) {
            $response = $this->_productCategoryRepository->simplePaginate($perPage, $select);
        } else {
            $response = $this->_productCategoryRepository->all($select);
        }
        return $this->_setResponseSuccess($response)->_getResponseSuccess();
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function store(array $attributes): array
    {
        if ($this->_productCategoryRepository->firstWhere(['title' => $attributes['title']])) {
            return $this->_setResponseError('Tiêu đề đã tồn tại')->_getResponseError();
        }
        if (isset($attributes['cat_name']) && $this->_productCategoryRepository->firstWhere(['cat_name' => $attributes['cat_name']])) {
            return $this->_setResponseError('Tên tiêu đề đã tồn tại')->_getResponseError();
        }
        try {
            $response = $this->_productCategoryRepository->create($attributes);
            return $this->_setResponseSuccess($response)->_getResponseSuccess();
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
        if ($this->_productCategoryRepository->firstWhere(['title' => $attributes['title'], ['id', '<>', $id]])) {
            return $this->_setResponseError('Tiêu đề đã tồn tại')->_getResponseError();
        }
        try {
            $response = $this->_productCategoryRepository->update($attributes, $id);
            return $this->_setResponseSuccess($response)->_getResponseSuccess();
        } catch (\Exception $e) {
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

        return $this->_setResponseSuccess($this->_productCategoryRepository->find($id))->_getResponseSuccess();
    }

    /**
     * @param int $id
     * @return array
     */
    public function destroy(int $id)
    {
        try {
            return $this->_setResponseSuccess($this->_productCategoryRepository->delete($id))->_getResponseSuccess();
        } catch (\Exception $e) {
            return $this->_setResponseError($e->getTraceAsString())->_getResponseError();
        }
    }

    protected function _setRelation(array $with = null)
    {
        $this->_productCategoryRepository = $this->_productCategoryRepository->with($with);
    }
}
