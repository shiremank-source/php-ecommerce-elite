<?php

if (php_sapi_name() === 'cli-server') {
    $path = __DIR__ . '/public' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if (file_exists($path) && !is_dir($path)) {
        return false; // Serve static file
    }
}

require_once __DIR__ . '/public/index.php';
