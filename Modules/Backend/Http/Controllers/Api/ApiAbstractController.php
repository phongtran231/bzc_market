<?php

namespace Modules\Backend\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

abstract class ApiAbstractController extends Controller
{
    protected function responseSuccess($data, $status = Response::HTTP_OK)
    {
        return response()->json([
            'data' => $data,
            'error' => false,
        ], $status);
    }

    protected function responseError(string $message = "Lỗi", $status = Response::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'data' => $message,
            'error' => true,
        ], $status);
    }
}
