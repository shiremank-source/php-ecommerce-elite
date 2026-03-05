<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>The Amazing Fruit People</title>

<link href="/assets/css/index.css" rel="stylesheet"/>
<link href="/assets/css/main1.css" rel="stylesheet"/>

</head>
<body>

<header>

    <div class="logo">
        <img src="/assets/images/logoV2.png" alt="Logo">
    </div>

    <nav>
        <a href="/">Home</a>
        <a href="/shop">Shop</a>
        <a href="#about">About</a>
        <a href="#contact">Contact</a>   
    </nav>

    <div class="header-buttons">
        <a href="/login" class="login-btn">Login</a>
        <a href="/cart" class="cart-btn">
            🛒 Cart
           <?php
require_once __DIR__ . '/../../services/CartService.php';
$cartService = new CartService();
?>

<span class="cart-count">
    <?= $cartService->count(); ?>
</span>
        </a>
    </div>
</header>
