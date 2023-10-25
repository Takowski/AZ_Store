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
        ob_start();
        $jsonFile = 'assets/json/catalog.json';

        function createCartItem($json, $id)
        {
            $shoppingCart = json_decode($json, true);
            array_push($shoppingCart, $json[$id]);
            saveShoppingCart($shoppingCart);
            displayShoppingCart();
            return $json;
        }

        function displayShoppingCart()
        {
            ob_clean();
            global $jsonFile;
            $json = file_get_contents($jsonFile);
            $cart = json_decode($json, true);
            $total = 0;
            echo '<section class="Cart">';
            if ($cart != "") {
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
                }
            }
        }

        function removeCartItem($index)
        {
            global $jsonFile;
            $json = file_get_contents($jsonFile);
            $cart = json_decode($json, true);

            if (isset($cart[$index])) {
                unset($cart[$index]);
                saveShoppingCart($cart);
            }
            displayShoppingCart();
        }

        function saveShoppingCart($cart)
        {
            global $jsonFile;
            $json = json_encode($cart, JSON_PRETTY_PRINT);
            file_put_contents($jsonFile, $json);
        }

        function addNumber($index)
        {
            global $jsonFile;
            $json = file_get_contents($jsonFile);
            $cart = json_decode($json, true);

            if (isset($cart[$index])) {
                $cart[$index]["number"] = $cart[$index]["number"] + 1;
                saveShoppingCart($cart);
            }
            displayShoppingCart();
        }
        function substractNumber($index)
        {
            global $jsonFile;
            $json = file_get_contents($jsonFile);
            $cart = json_decode($json, true);
            if ($cart[$index]["number"] > 1) {
                if (isset($cart[$index])) {
                    $cart[$index]["number"] = $cart[$index]["number"] - 1;
                    saveShoppingCart($cart);
                }
                displayShoppingCart();
            }
        }



        if (isset($_POST['submit'])) {
            displayShoppingCart();
        }

        if (isset($_POST['remove_item'])) {
            $itemIndex = $_POST['remove_item'];
            removeCartItem($itemIndex);
        }
        displayShoppingCart();



        if (isset($_POST['Add_Number'])) {
            $itemIndex = $_POST['Add_Number'];
            addNumber($itemIndex);
        }
        if (isset($_POST['Substract_Number'])) {
            $itemIndex = $_POST['Substract_Number'];
            substractNumber($itemIndex);
        }


        echo "<form action='checkout.php'>";
        echo "<button class='Cart__Confirm'>Confirm</button>";
        echo "</form>";
        ?>

  

  </main>

</body>
</html>