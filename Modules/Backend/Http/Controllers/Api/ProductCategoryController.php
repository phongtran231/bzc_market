<?php

namespace Modules\Backend\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Backend\Http\Requests\StoreProductCategoryRequest;
use Modules\Backend\Services\ProductCategory\ProductCategoryServiceInterface;

class ProductCategoryController extends ApiAbstractController implements ResourceInterface
{

    protected $_productCategoryService;

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

    public function update()
    {

    }
}
