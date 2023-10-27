<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

function createCartItem($id)
{
    $catalog = json_decode(file_get_contents('assets/json/catalog.json'), true);
    $item = $catalog[$id];
    $item['number'] = 1;
    array_push($_SESSION['cart'], $item);
}

function removeCartItem($index)
{
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
    }
}

function removeAllCartItems()
{
    $_SESSION['cart'] = array();
}

function addNumber($index)
{
    if (isset($_SESSION['cart'][$index])) {
        $_SESSION['cart'][$index]['number']++;
    }
}

function substractNumber($index)
{
    if (isset($_SESSION['cart'][$index])) {
        if ($_SESSION['cart'][$index]['number'] > 1) {
            $_SESSION['cart'][$index]['number']--;
        }
    }
}

function displayShoppingCart()
{
    $cart = $_SESSION['cart'];
    $total = 0;
    echo '<section class="Cart">';
    if (!empty($cart)) {
        foreach ($cart as $index => $item) {
            $price = $item["price"] * $item["number"];
            echo "<div class='Cart__Item'>";
            echo "<img class='Cart__Item__Image' src='$item[image_url]' alt='Picture of a shoe'>";
            echo "<span class='Cart__Item__Product'>$item[product]</span>";
            echo "<span class='Cart__Item__Price'>$price € </span>";

            echo '<form action="shopping-cart.php" method="post">';
            echo "<input type='hidden' name='Substract_Number' value='$index'>";
            echo "<input type='submit' class='Cart__Item__Substract' value='-'>";
            echo "</form>";
            echo "<span class='Cart__Item__Price'>$item[number]</span>";
            echo '<form action="shopping-cart.php" method="post">';
            echo "<input type='hidden' name='Add_Number' value='$index'>";
            echo "<input type='submit' class='Cart__Item__Add' value='+'>";
            echo '</form>';
            echo "<form action='shopping-cart.php' method='post'>";
            echo "<input type='hidden' name='remove_item' value='$index'>";
            echo "<input type='submit' class='Cart__Item__Remove' value='Remove'>";
            echo "</form>";
            echo "</div>";

            $total = $total + $price;
        }
        echo "</section>";
        if ($total != 0) {
            echo "<span class='Cart__Item__Total'>$total €</span>";
            $_SESSION['total'] = $total;
        }
    }
}

if (isset($_POST['add_item'])) {
    $itemIndex = $_POST['add_item'];
    createCartItem($itemIndex);
}

if (isset($_POST['remove_item'])) {
    $itemIndex = $_POST['remove_item'];
    removeCartItem($itemIndex);
}

if (isset($_POST['remove_all_items'])) {
    removeAllCartItems();
}

if (isset($_POST['Add_Number'])) {
    $itemIndex = $_POST['Add_Number'];
    addNumber($itemIndex);
}

if (isset($_POST['Substract_Number'])) {
    $itemIndex = $_POST['Substract_Number'];
    substractNumber($itemIndex);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping cart of NIQUE</title>
</head>

<body>
    <!-- Style temporaire image trop grande -->
    <style>
        img {
            width: 100px;
            height: 100px;
        }
    </style>
    <?php include 'header-display.php' ?>
    <main>
        <?php
        displayShoppingCart();
        echo "<span class='Cart__Item__Number'>$item[number]</span>";
        // createCartItem(0);
        ?>
        <form action='checkout.php'>
            <button class='Cart__Confirm'>Confirm</button>
        </form>
        <form action='shopping-cart.php' method='post'>
            <input type='hidden' name='remove_all_items' value='true'>
            <input type='submit' class='Cart__Remove_All' value='Remove All'>
        </form>
    </main>

</body>

</html>