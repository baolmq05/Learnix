<?php
require_once 'Models/Cart.php';
class CartController
{
    public function viewCart()
    {
        $user_id = $_SESSION['client']['id'] ?? '';
        $cartModel = new Cart();
        $cartItems = $cartModel->getAllCart($user_id);
        // echo "<pre>";
        // print_r($cartItems);
        $totalPrice = 0;
        $totalPriceSale = 0;
        $totalNoSale = 0;
        foreach ($cartItems as $item) {
            $totalNoSale += $item['regular_price'];
            $totalPriceSale += $item['sale_price'];
            if ($item['sale_price'] != 0) {
                $totalPrice += $item['sale_price'];
            } else {
                $totalPrice += $item['regular_price'];
            }
        }
        include "Views/Client/Pages/cart.php";
    }
}
