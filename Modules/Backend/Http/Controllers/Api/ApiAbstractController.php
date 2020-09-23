<?php

namespace Modules\Backend\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

abstract class ApiAbstractController extends Controller
{
    protected function _responseSuccess($data, $status = Response::HTTP_OK)
    {
        return response()->json([
            'data' => $data,
            'error' => false,
        ], $status);
    }

    protected function _responseError($message = "Lỗi", $status = Response::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'data' => $message,
            'error' => true,
        ], $status);
    }

    /**
     * @param array $response
     * @return \Illuminate\Http\JsonResponse
     */
    protected function _returnResponse(array $response)
    {
        if ($response['error']) {
            return $this->_responseError($response['data']);
        }
        return $this->_responseSuccess($response['data']);
    }
}
