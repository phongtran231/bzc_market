<?php

namespace Modules\Backend\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Backend\Requests\StoreCoreConfigRequest;
use Modules\Backend\Services\CoreConfig\CoreConfigServiceInterface;

class CoreConfigController extends ApiAbstractController implements ResourceInterface
{

    /**
     * @var CoreConfigServiceInterface
     */
    protected $_coreConfigService;

    public function __construct(
        CoreConfigServiceInterface $coreConfigService
    )
    {
        $this->_coreConfigService = $coreConfigService;
    }

    public function index(Request $request)
    {
        return $this->responseSuccess($this->_coreConfigService->getAllCoreConfig());
    }

    public function getCoreConfigPaginate()
    {
        return $this->responseSuccess($this->_coreConfigService->getAllCoreConfig(['*'], true));
    }

    public function show(Request $request, int $id)
    {
        return $this->responseSuccess($this->_coreConfigService->getOneCoreConfig($id));
    }

    public function store(StoreCoreConfigRequest $request)
    {

    }
}
