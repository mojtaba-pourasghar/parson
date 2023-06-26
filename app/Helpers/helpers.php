<?php

use Jenssegers\Agent\Agent;

if (!function_exists('backendTheme')) {
    function backendTheme($path)
    {
        $config = app('config')->get('cms.theme');
        return url($config['folder'] . '/backend/' . $config['active']['back'] . '/assets/' . $path);
    }
}
if (!function_exists('frontendTheme')) {
    function frontendTheme($path)
    {
        $config = app('config')->get('cms.theme');
        $Agent = new Agent();

        if ($Agent->isMobile() || $Agent->isTablet()) {
            return url($config['folder'] . '/frontend/' . $config['active']['mobile'] . '/assets/' . $path);
        } else {
            return url($config['folder'] . '/frontend/' . $config['active']['front'] . '/assets/' . $path);
        }

    }
}
if (!function_exists('currentBackView')) {
    function currentBackView($path)
    {
        $config = app('config')->get('cms.theme');
        return 'backend/' . $config['active']['back'] . '/' . $path;
    }
}
if (!function_exists('currentFrontView')) {
    function currentFrontView($path)
    {
        $config = app('config')->get('cms.theme');
        $Agent = new Agent();

        if ($Agent->isMobile() || $Agent->isTablet()) {
            return 'frontend/' . $config['active']['mobile'] . '/' . $path;
        } else {
            return 'frontend/' . $config['active']['front'] . '/' . $path;
        }
    }
}

if (!function_exists('getConstant')) {
    function getConstant($path)
    {
        $config = app('config')->get('constants.' . $path);
        return $config;
    }
}
if (!function_exists('flash')) {
    function flash($message = NULL)
    {
        $flash = app('App\Http\Flash');
        if (func_num_args() == 0) {
            return $flash;
        }
        return $flash->info($message);
    }
}

if (!function_exists('createQueryString')) {
    function createQueryString($url, $item)
    {
        if (strpos($url, '?') > 0)
            return $url .= '&' . $item;
        return $url .= '?' . $item;
    }
}

