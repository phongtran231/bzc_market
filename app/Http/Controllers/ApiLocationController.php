<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class ApiLocationController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCity()
    {
        $url = config('api_location.api_get_city');
        $response = $this->_callCurl($url);
        return response()->json([
            'data' => $response->LtsItem,
            'error' => false,
        ]);
    }

    /**
     * @param int $cityId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCityDetail(int $cityId)
    {
        $url = config('api_location.api_get_city');
        return response()->json([
            'data' => $this->_callCurl($url . "/{$cityId}"),
            'error' => false,
        ]);
    }

    /**
     * @param int $cityId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDistrictByCity(int $cityId)
    {
        $url = config('api_location.api_get_district_by_city');
        $url = str_replace('{city_id}', $cityId, $url);
        return response()->json([
            'data' => $this->_callCurl($url),
            'error' => false,
        ]);
    }

    /**
     * @param int $districtId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDistrictDetail(int $districtId)
    {
        $url = config('api_location.api_get_district_detail');
        return response()->json([
            'data' => $this->_callCurl($url . "/{$districtId}"),
            'error' => false,
        ]);
    }

    /**
     * @param int $districtId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWardByDistrict(int $districtId)
    {
        $url = config('api_location.api_get_ward_by_district');
        $url = str_replace('{district_id}', $districtId, $url);
        return response()->json([
            'data' => $this->_callCurl($url),
            'error' => false,
        ]);
    }

    /**
     * @param int $wardId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWardDetail(int $wardId)
    {
        $url = config('api_location.api_get_ward_detail');
        return response()->json([
            'data' => $this->_callCurl($url . "/{$wardId}"),
            'error' => false,
        ]);
    }

    /**
     * @param string $url
     * @return string
     */
    protected function _callCurl(string $url)
    {
        $client = new Client();
        return json_decode($client->get($url)->getBody()->getContents());
    }
}
