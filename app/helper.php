<?php

if (function_exists('_backend_asset')) {
    /**
     * @param string $path
     * @return string
     */
    function _backend_asset(string $path): string
    {
        return asset("backend/{$path}");
    }
}