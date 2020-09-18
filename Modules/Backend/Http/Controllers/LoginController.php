<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Backend\Services\Test\TestServiceInterface;

class LoginController extends Controller
{
    protected $testService;

    public function __construct(
        TestServiceInterface $testService
    ) {
        $this->testService = $testService;
    }

    /**
     * @param Request $request
     */
    public function login(Request $request)
    {
    }
}
