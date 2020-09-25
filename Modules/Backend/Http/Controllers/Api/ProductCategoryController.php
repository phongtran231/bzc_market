<?php

namespace Modules\Backend\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Backend\Http\Requests\StoreProductCategoryRequest;
use Modules\Backend\Http\Requests\UpdateProductCategoryRequest;
use Modules\Backend\Services\ProductCategory\ProductCategoryServiceInterface;

class ProductCategoryController extends ApiAbstractController implements ResourceInterface
{

    /**
     * @var ProductCategoryServiceInterface
     */
    protected $_productCategoryService;

    /**
     * ProductCategoryController constructor.
     * @param ProductCategoryServiceInterface $productCategoryService
     */
    public function __construct(
        ProductCategoryServiceInterface $productCategoryService
    )
    {
        $this->_productCategoryService = $productCategoryService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') ?? 0;
        return $this->_returnResponse($this->_productCategoryService->index(['*'], $request->has('paginate'), $limit));
    }

    /**
     * @param StoreProductCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProductCategoryRequest $request)
    {
        return $this->_returnResponse($this->_productCategoryService->store($request->input()));
    }

    /**
     * @param UpdateProductCategoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProductCategoryRequest $request, int $id)
    {
        $response = $this->_productCategoryService->update($request->except(['cat_name', 'parent_id']), $id);
        return $this->_returnResponse($response);
    }
}
