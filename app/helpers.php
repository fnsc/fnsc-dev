<?php

if (!function_exists('custom_asset')) {
    function custom_asset(string $config, string $query = '')
    {
        return 'local' === config('app.env')
            ? asset($config) . $query
            : secure_asset($config) . $query;
    }
}
