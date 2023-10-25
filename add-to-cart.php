<!-- <?php
// function addToCart($product_id, $quantity) {
//     $cartFile = 'cart.json';

//     $cartData = file_exists($cartFile) ? json_decode(file_get_contents($cartFile), true) : [];

   
//     if (isset($cartData[$product_id])) {
//         $cartData[$product_id] += $quantity;
//     } else {
//         $cartData[$product_id] = $quantity;
//     }

//     file_put_contents($cartFile, json_encode($cartData));
// }


// if (isset($_POST['productId']) && isset($_POST['quantity'])) {
//     $product_id = $_POST['productId'];
//     $quantity = $_POST['quantity'];
//     addToCart($product_id, $quantity);
// } 

?>  -->

<!-- <?php
// session_start();


// function addToCart($product_id, $quantity) {
//     if (!isset($_SESSION['cart'])) {
//         $_SESSION['cart'] = array();
//     }

//     if (isset($_SESSION['cart'][$product_id])) {
//         $_SESSION['cart'][$product_id] += $quantity;
//     } else {
//         $_SESSION['cart'][$product_id] = $quantity;
//     }
// }

// if (isset($_POST['productId']) && isset($_POST['quantity'])) {
//     $product_id = $_POST['productId'];
//     $quantity = $_POST['quantity'];
//     addToCart($product_id, $quantity);
// } 
?> -->


<?php

$products = json_decode(file_get_contents('cart.json'), true);

function addToCart($product_id, $quantity, $products) {
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


