<?php

session_start();

if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

require_once __DIR__ . '/../app/Router.php';
require_once __DIR__ . '/../app/services/CartService.php';
require_once __DIR__ . '/../app/controllers/HomeController.php';

$router = new Router();
$controller = new HomeController();
$cartService = new CartService();

// GET Routes
$router->get('/', [$controller, 'index']);
$router->get('/shop', [$controller, 'shop']);
$router->get('/cart', [$controller, 'cart']);

// POST Route: Add to Cart
$router->post('/cart/add', function() use ($cartService) {

    // 1️⃣ Validate CSRF
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
        http_response_code(403);
        exit('CSRF validation failed');
    }

    // 2️⃣ Get product name
    $name = $_POST['name'] ?? '';

    // 3️⃣ Trusted product list (server-side)
    $products = [
        'Fresh Apples' => [
            'name' => 'Fresh Apples',
            'price' => 3.99,
            'image' => '/assets/images/apples.jpeg'
        ],
        'Strawberries' => [
            'name' => 'Strawberries',
            'price' => 4.99,
            'image' => '/assets/images/strawberry.avif'
        ],
        'Bananas' => [
            'name' => 'Bananas',
            'price' => 1.99,
            'image' => '/assets/images/bananas.avif'
        ]
    ];

    // 4️⃣ Validate product exists
    if (!isset($products[$name])) {
        http_response_code(400);
        exit('Invalid product');
    }

    // 5️⃣ Add securely
    $cartService->add($products[$name]);

    // 6️⃣ Redirect (Post/Redirect/Get pattern)
    header("Location: /shop");
    exit;
});

$router->post('/cart/remove', function() use ($cartService) {

    // 1️⃣ Validate CSRF
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
        http_response_code(403);
        exit('CSRF validation failed');
    }

    // 2️⃣ Get product ID
    $id = $_POST['id'] ?? '';

    // 3️⃣ Remove item
    $cartService->remove($id);

    // 4️⃣ Redirect
    header("Location: /cart");
    exit;
});
// Increase quantity

    // 1️⃣ Validate CSRF
$router->post('/cart/increase', function() use ($cartService) {

    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
        http_response_code(403);
        exit('CSRF validation failed');
    }

    $id = $_POST['id'] ?? '';

    $cart = $cartService->getCart();

    if (isset($cart[$id])) {
        $cartService->add($cart[$id]);
    }

    header("Location: /cart");
    exit;
});


// Decrease quantity
$router->post('/cart/decrease', function() use ($cartService) {

    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
        http_response_code(403);
        exit('CSRF validation failed');
    }

    $id = $_POST['id'] ?? '';

    $cartService->remove($id);

    header("Location: /cart");
    exit;
});
// Resolve request
$router->resolve($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
