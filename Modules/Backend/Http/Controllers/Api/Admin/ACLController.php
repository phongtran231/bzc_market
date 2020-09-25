<?php

namespace Modules\Backend\Http\Controllers\Api\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Modules\Backend\Http\Controllers\Api\ApiAbstractController;
use Modules\Backend\Http\Requests\SetRoleForAdminRequest;
use Modules\Backend\Services\ACL\ACLServiceInterface;

class ACLController extends ApiAbstractController
{

    /**
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $_auth;

    /**
     * @var ACLServiceInterface
     */
    protected $_ACLService;

    /**
     * ACLController constructor.
     * @param ACLServiceInterface $ACLService
     */
    public function __construct(
        ACLServiceInterface $ACLService
    )
    {
        $this->_auth = auth(Admin::GUARD_NAME);
        $this->_ACLService = $ACLService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createRole(Request $request)
    {
        $response = $this->_ACLService->createRole($request->input());
        return $this->_returnResponse($response);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPermission(Request $request)
    {
        $response = $this->_ACLService->createPermission($request->input());
        return $this->_returnResponse($response);
    }

    /**
     * @param SetRoleForAdminRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setRoleForAdmin(SetRoleForAdminRequest $request)
    {
        $response = $this->_ACLService->setRoleForAdmin($request->input());
        return $this->_returnResponse($response);
    }
}
