<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$publicPath = __DIR__ . '/public' . $uri;

// If file exists in public folder, let PHP serve it
if ($uri !== '/' && file_exists($publicPath) && !is_dir($publicPath)) {
    return false;
}

// Otherwise send to front controller
require_once __DIR__ . '/public/index.php';
