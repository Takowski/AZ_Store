<!-- <?php
function addToCart($product_id, $quantity) {
    $cartFile = 'cart.json';

    $cartData = file_exists($cartFile) ? json_decode(file_get_contents($cartFile), true) : [];

   
    if (isset($cartData[$product_id])) {
        $cartData[$product_id] += $quantity;
    } else {
        $cartData[$product_id] = $quantity;
    }

    file_put_contents($cartFile, json_encode($cartData));
}


if (isset($_POST['productId']) && isset($_POST['quantity'])) {
    $product_id = $_POST['productId'];
    $quantity = $_POST['quantity'];
    addToCart($product_id, $quantity);
} 

?> -->


