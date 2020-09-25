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
     * @return array
     */
    public function index(array $select = ['*'], bool $paginate = true, int $perPage = 20)
    {
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
        try {
            $response = $this->_productCategoryRepository->create($attributes);
            return $this->_setResponseSuccess($response)->_getResponseSuccess();
        } catch (\Exception $e) {
            return $this->_setResponseError($e->getTraceAsString())->_getResponseError();
        }
    }
}
