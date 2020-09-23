<?php

namespace Modules\Backend\Http\Controllers\Api;

use App\Models\ShopOwner;
use Illuminate\Http\Request;
use Modules\Backend\Http\Requests\ShopOwnerResetPasswordRequest;
use Modules\Backend\Http\Requests\StoreShopOwnerRequest;
use Modules\Backend\Services\ShopOwner\ShopOwnerServiceInterface;

class ShopOwnerController extends ApiAbstractController implements ResourceInterface
{

    /**
     * @var ShopOwnerServiceInterface
     */
    protected $_shopOwnerService;

    /**
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $_auth;

    /**
     * ShopOwnerController constructor.
     * @param ShopOwnerServiceInterface $shopOwnerService
     */
    public function __construct(
        ShopOwnerServiceInterface $shopOwnerService
    )
    {
        $this->_shopOwnerService = $shopOwnerService;
        $this->_auth = auth(ShopOwner::GUARD_NAME);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') ?? 0;
        return $this->_returnResponse($this->_shopOwnerService->index(['*'], $request->has('paginate'), $limit));
    }

    public function show(Request $request, int $id)
    {

    }

    /**
     * @param StoreShopOwnerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreShopOwnerRequest $request)
    {
        $response = $this->_shopOwnerService->store($request->input());
        return $this->_returnResponse($response);
    }

    /**
     * @param ShopOwnerResetPasswordRequest $request
     * @param string $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(ShopOwnerResetPasswordRequest $request, string $token)
    {
        $request->merge([
            'user_mail' => $token,
        ]);

        $response = $this->_shopOwnerService->resetPassword($request->input(), $this->_auth->user());
        return $this->_returnResponse($response);
    }
}
