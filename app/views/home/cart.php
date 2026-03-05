<h1>Your Cart</h1>

<?php
$cartService = new CartService();
$cart = $cartService->getCart();
$total = 0;
?>

<?php if (empty($cart)): ?>
    <p>Cart is empty.</p>
<?php else: ?>

    <?php foreach ($cart as $id => $item): ?>
<div class="cart-item">
    <img src="<?= $item['image'] ?>" width="80">
    <strong><?= htmlspecialchars($item['name']) ?></strong>

    <div class="quantity-controls">

        <!-- Decrease -->
        <form method="POST" action="/cart/decrease">
            <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
            <button type="submit">−</button>
        </form>

        <span><?= $item['quantity'] ?></span>

        <!-- Increase -->
        <form method="POST" action="/cart/increase">
            <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
            <button type="submit">+</button>
        </form>

    </div>

    <p>$<?= number_format($item['price'] * $item['quantity'], 2) ?></p>

</div>

        <?php $total += $item['price'] * $item['quantity']; ?>
    <?php endforeach; ?>

    <hr>
    <h3>Total: $<?= number_format($total, 2) ?></h3>

<?php endif; ?>
