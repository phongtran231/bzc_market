<?php

namespace Modules\Backend\Services\Test;

use Illuminate\Http\Request;

interface TestServiceInterface
{
    /**
     * @param Request $request
     */
    public function checkout(Request $request): void;
}