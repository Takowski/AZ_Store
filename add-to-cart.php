<?php
session_start();

$products = json_decode(file_get_contents('catalog.json'), true);

function addToCart($product_id, $quantity, $products)
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    foreach ($products as $product) {
        if ($product['id'] == $product_id) {
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                $_SESSION['cart'][$product_id] = $quantity;
            }
            break;
        }
    }
}

?>


