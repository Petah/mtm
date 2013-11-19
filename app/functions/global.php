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

function render($view, $data = [], $layout = 'default') {
    include ROOT . '/app/views/layouts/' . $layout . '.php';
}
