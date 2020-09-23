<?php

namespace Modules\Backend\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Backend\Http\Requests\StoreCoreConfigRequest;
use Modules\Backend\Http\Requests\UpdateCoreConfigRequest;
use Modules\Backend\Services\CoreConfig\CoreConfigServiceInterface;

class CoreConfigController extends ApiAbstractController implements ResourceInterface
{

    /**
     * @var CoreConfigServiceInterface
     */
    protected $_coreConfigService;

    /**
     * CoreConfigController constructor.
     * @param CoreConfigServiceInterface $coreConfigService
     */
    public function __construct(
        CoreConfigServiceInterface $coreConfigService
    )
    {
        $this->_coreConfigService = $coreConfigService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = (int) $request->input('limit') ?? 0;
        return $this->_returnResponse($this->_coreConfigService->index(['*'], $request->has('paginate'), $limit));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, int $id)
    {
        return $this->_returnResponse($this->_coreConfigService->show($id));
    }

    /**
     * @param StoreCoreConfigRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCoreConfigRequest $request)
    {
        $response = $this->_coreConfigService->store($request->input());
        return $this->_returnResponse($response);
    }

    /**
     * @param UpdateCoreConfigRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCoreConfigRequest $request, int $id)
    {
        $response = $this->_coreConfigService->update($request->except('key_name'), $id);
        return $this->_returnResponse($response);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $response = $this->_coreConfigService->destroy($id);
        return $this->_responseSuccess($response);
    }
}
