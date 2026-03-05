<h1>Shop</h1>

<div class="product-grid">
    <?php foreach ($products as $product): ?>
        <div class="product-card">
            <img src="<?= $product['image'] ?>" width="150">
            <h3><?= htmlspecialchars($product['name']) ?></h3>
            <p>$<?= number_format($product['price'], 2) ?></p>

            <form method="POST" action="/cart/add">
                <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
                <input type="hidden" name="name" value="<?= htmlspecialchars($product['name']) ?>">
                <button type="submit">Add to Cart</button>
            </form>

        </div>
    <?php endforeach; ?>
</div>
