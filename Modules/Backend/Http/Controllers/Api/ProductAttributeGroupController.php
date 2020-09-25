<?php

namespace Modules\Backend\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Backend\Http\Requests\StoreProductAttributeGroupRequest;
use Modules\Backend\Http\Requests\UpdateProductAttributeGroupRequest;
use Modules\Backend\Services\ProductAttributeGroup\ProductAttributeGroupServiceInterface;

class ProductAttributeGroupController extends ApiAbstractController implements ResourceInterface
{

    protected $_productAttributeGroupService;

    public function __construct(
        ProductAttributeGroupServiceInterface $productAttributeGroupService
    )
    {
        $this->_productAttributeGroupService = $productAttributeGroupService;
    }

    public function index(Request $request)
    {
        return $this->_returnResponse($this->_productAttributeGroupService->index(['*'], $request->has('paginate'), $request->input('limit') ?? 0));
    }

    public function store(StoreProductAttributeGroupRequest $request)
    {
        return $this->_returnResponse($this->_productAttributeGroupService->store($request->input()));
    }

    public function update(UpdateProductAttributeGroupRequest $request, int $id)
    {
        return $this->_returnResponse($this->_productAttributeGroupService->update($request->input(), $id));
    }

    public function show(int $id)
    {
        return $this->_returnResponse($this->_productAttributeGroupService->show($id));
    }
}
