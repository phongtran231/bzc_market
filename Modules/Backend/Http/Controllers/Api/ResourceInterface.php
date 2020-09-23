<?php

namespace Modules\Backend\Http\Controllers\Api;

use Illuminate\Http\Request;

interface ResourceInterface
{
    public function index(Request $request);
}
