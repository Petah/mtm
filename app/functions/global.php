<?php
/**
 * MTM global functions.
 *
 * @author David Neilsen <petah.p@gmail.com>
 */

function getRequestedURL() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? 'https' : 'http';
    $host = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';
    $query = '';
    $uri = '/' . ltrim(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '', '/');
    if ($pos = strpos($uri, '?')) {
        $query = substr($uri, $pos);
        $uri = substr($uri, 0, $pos);
    }
    $port = null;
    if ($protocol === 'http' && isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != 80) {
        $port = ':' . $_SERVER['SERVER_PORT'];
    }
    return "$protocol://$host$port$uri$query";
}

function buildQuery(array $data) {
    $query = [];
    uksort($data, 'strnatcasecmp');
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            natcasesort($value);
            $value = implode(',', $value);
        }
        $value = preg_replace('/[^a-z0-9,]/i', '', $value);
        if ($value) {
            $key = preg_replace('/[^a-z0-9_]/i', '', $key);
            $query[] = $key . '=' . $value;
        }
    }
    return implode('&', $query);
}

function render($view, $data = [], $layout = 'default') {
    $data = new MTM\DataRenderer($data);
    include ROOT . '/app/views/layouts/' . $layout . '.php';
}

function dump() {
    echo '<pre>';
    foreach (func_get_args() as $arg) {
        var_dump($arg);
    }
    if (function_exists('xdebug_print_function_stack')) {
        xdebug_print_function_stack();
    } else {
        debug_print_backtrace();
    }
    die('Execution killed by: ' . __FUNCTION__);
}