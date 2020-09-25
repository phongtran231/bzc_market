<?php

namespace Modules\Backend\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

abstract class ApiAbstractController extends Controller
{
    /**
     * @param $data
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function _responseSuccess($data, int $status = Response::HTTP_OK)
    {
        return response()->json([
            'data' => $data,
            'error' => false,
        ], $status);
    }

    /**
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function _responseError($message = "Lỗi", int $status = Response::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'data' => $message,
            'error' => true,
        ], $status);
    }

    /**
     * @param array $response
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function _returnResponse(array $response, int $status = Response::HTTP_OK)
    {
        if ($response['error']) {
            return $this->_responseError($response['data'], Response::HTTP_BAD_REQUEST);
        }
        return $this->_responseSuccess($response['data'], $status);
    }
}
