<?php

namespace Modules\Backend\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Backend\Http\Requests\SetProductAttributeToGroupRequest;
use Modules\Backend\Http\Requests\StoreProductAttributeRequest;
use Modules\Backend\Http\Requests\UpdateProductAttributeRequest;
use Modules\Backend\Services\ProductAttribute\ProductAttributeServiceInterface;

class ProductAttributeController extends ApiAbstractController implements ResourceInterface
{

    /**
     * @var ProductAttributeServiceInterface
     */
    protected $_productAttributeService;

    /**
     * ProductAttributeController constructor.
     * @param ProductAttributeServiceInterface $productAttributeService
     */
    public function __construct(
        ProductAttributeServiceInterface $productAttributeService
    )
    {
        $this->_productAttributeService = $productAttributeService;
    }

    public function index(Request $request)
    {
        // TODO: Implement index() method.
    }

    /**
     * @param StoreProductAttributeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProductAttributeRequest $request)
    {
        return $this->_returnResponse($this->_productAttributeService->store($request->input()));
    }

    /**
     * @param UpdateProductAttributeRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProductAttributeRequest $request, $id)
    {
        return $this->_returnResponse($this->_productAttributeService->update($request->input(), $id));
    }

    public function show(int $id)
    {

    }

    public function destroy(int $id)
    {
        return $this->_returnResponse($this->_productAttributeService->destroy($id));
    }

    public function setGroup(SetProductAttributeToGroupRequest $request, int $id)
    {
        return $this->_returnResponse($this->_productAttributeService->setGroup($request->input('attribute_group_id'), $id));
    }
}
