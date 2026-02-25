<?php

// Start session
session_start();

// Load environment variables (basic version)
require_once __DIR__ . '/../app/config/database.php';

// Simple router
$request = $_SERVER['REQUEST_URI'];

if ($request === '/') {
    echo "Home Page";
} elseif ($request === '/shop') {
    echo "Shop Page";
} elseif ($request === '/cart') {
    echo "Cart Page";
} else {
    http_response_code(404);
    echo "404 Not Found";




















