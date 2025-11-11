<?php
class CartController {
    public function viewCart() {
        include "Views/Client/Pages/cart.php";
    }

    public function addToCart($productId, $quantity) {
        // Code to add product to cart
    }

    public function removeFromCart($productId) {
        // Code to remove product from cart
    }

    public function updateCart($productId, $quantity) {
        // Code to update product quantity in cart
    }
}