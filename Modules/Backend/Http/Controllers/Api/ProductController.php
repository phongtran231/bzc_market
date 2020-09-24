<?php

namespace Modules\Backend\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Backend\Http\Requests\StoreProductRequest;
use Modules\Backend\Http\Requests\UpdateProductRequest;
use Modules\Backend\Services\Product\ProductServiceInterface;

class ProductController extends ApiAbstractController implements ResourceInterface
{

    /**
     * @var ProductServiceInterface
     */
    protected $_productService;

    public function __construct(
        ProductServiceInterface $productService
    )
    {
        $this->_productService = $productService;
    }
    
    public function index(Request $request)
    {
        $limit = $request->input('limit') ?? 0;
        return $this->_returnResponse($this->_productService->index(['*'], $request->has('paginate'), $limit));
    }

    public function store(StoreProductRequest $request)
    {
        $response = $this->_productService->store($request->input());
        return $this->_returnResponse($response);
    }

    public function show(Request $request)
    {
        $id = $request->input('id') ?? 0;
        return $this->_returnResponse($this->_productService->show($id));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $response = $this->_productService->update($request->input(), $id);
        return $this->_returnResponse($response);
    }

    public function destroy($id)
    {
        return $this->_returnResponse($this->_productService->delete($id));
    }
}
