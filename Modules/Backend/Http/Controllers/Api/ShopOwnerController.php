<?php

namespace Modules\Backend\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Backend\Requests\StoreShopOwnerRequest;
use Modules\Backend\Services\ShopOwner\ShopOwnerServiceInterface;

class ShopOwnerController extends ApiAbstractController implements ResourceInterface
{
    protected $_shopOwnerService;

    public function __construct(
        ShopOwnerServiceInterface $shopOwnerService
    )
    {
        $this->_shopOwnerService = $shopOwnerService;
    }

    public function index(Request $request)
    {
        // TODO: Implement index() method.
    }

    public function show(Request $request, int $id)
    {
        // TODO: Implement show() method.
    }

    public function store(StoreShopOwnerRequest $request)
    {
        $response = $this->_shopOwnerService->store($request->input());
        if ($response) {
            return $this->responseSuccess($response);
        }
        return $this->responseError("Đã có lỗi vui lòng thử lại");
    }
}
