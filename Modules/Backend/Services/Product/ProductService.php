<?php

namespace Modules\Backend\Services\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use Modules\Backend\Services\BaseService;

class ProductService extends BaseService implements ProductServiceInterface
{

    /**
     * @var ProductRepositoryInterface
     */
    protected $_productRepository;

    /**
     * ProductService constructor.
     * @param ProductRepositoryInterface $shopOwnerRepository
     */
    public function __construct(
        ProductRepositoryInterface $shopOwnerRepository
    )
    {
        $this->_productRepository = $shopOwnerRepository;
    }

    /**
     * @param array|string[] $select
     * @param bool $paginate
     * @param int $perPage
     * @return \App\Models\Product[]|array
     */
    public function index(array $select = ['*'], bool $paginate = true, int $perPage = 20)
    {
        if ($paginate) {
            $response = $this->_productRepository->simplePaginate($perPage, $select);
        } else {
            $response = $this->_productRepository->all($select);
        }
        return $this->_setResponseSuccess($response)->_getResponseSuccess();
    }

    /**
     * @param int $id
     * @return \App\Models\Product|array
     */
    public function show(int $id)
    {
        $data = $this->_productRepository->find($id);
        if ($data) {
            return $this->_setResponseSuccess($data)->_getResponseSuccess();
        }

        return $this->_setResponseError('Không tìm thấy sản phẩm!')->_getResponseError();
    }

    /**
     * @param array $attributes
     * @return \App\Models\Product|array
     */
    public function store(array $attributes)
    {
        $data = $this->_productRepository->create($attributes);
        if ($data) {
            return $this->_setResponseSuccess($data)->_getResponseSuccess();
        }

        return $this->_setResponseError('Không thể tạo sản phẩm!')->_getResponseError();
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return \App\Models\Product|array
     */
    public function update(array $attributes, int $id)
    {
        $data = $this->_productRepository->update($attributes, $id);
        if ($data) {
            return $this->_setResponseSuccess($data)->_getResponseSuccess();
        }

        return $this->_setResponseError('Không thể cập nhật sản phẩm!')->_getResponseError();
    }

    /**
     * @param int $id
     * @return array|bool
     */
    public function delete(int $id)
    {
        $data = $this->_productRepository->delete($id);
        if ($data) {
            return $this->_setResponseSuccess($data)->_getResponseSuccess();
        }

        return $this->_setResponseError('Không thể xóa sản phẩm!')->_getResponseError();
    }
}
