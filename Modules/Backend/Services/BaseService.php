<?php

namespace Modules\Backend\Services;

abstract class BaseService implements BaseServiceInterface
{

    protected $_error = [
        'error' => true,
        'data' => null,
    ];

    protected $_data = [
        'error' => false,
        'data' => null,
    ];

    /**
     * @param $error
     * @return $this
     */
    protected function _setResponseError($error)
    {
        if (is_string($error)) {
            $this->_error['data']['message'][] = $error;
        }
        if (is_array($error) && !array_key_exists('error', $error)) {
            $this->_error['data']['message'] = array_values($error);
        }
        if (is_array($error) && array_key_exists('error', $error)) {
            $this->_error['data'] = $error;
            $this->_error['error'] = $error['error'];
            unset($this->_error['data']['error']);
        }
        return $this;
    }

    /**
     * @return array
     */
    protected function _getResponseError()
    {
        return $this->_error;
    }

    /**
     * @param $data
     * @return $this
     */
    protected function _setResponseSuccess($data)
    {
        $this->_data['data'] = $data;
        return $this;
    }

    /**
     * @return array
     */
    protected function _getResponseSuccess()
    {
        return $this->_data;
    }
}
