<?php

class CartService
{
    public function getCart()
    {
        return $_SESSION['cart'] ?? [];
    }

    public function add($product)
    {
        $cart = $this->getCart();

        $id = $product['name'];

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = $product;
            $cart[$id]['quantity'] = 1;
        }

        $_SESSION['cart'] = $cart;
    }

    public function remove($id)
    {
        $cart = $this->getCart();

        if (isset($cart[$id])) {
            $cart[$id]['quantity']--;

            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
            }
        }

        $_SESSION['cart'] = $cart;
    }

    public function count()
    {
        $cart = $this->getCart();
        return array_sum(array_column($cart, 'quantity'));
    }
}

