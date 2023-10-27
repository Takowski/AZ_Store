<?php
session_start();

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nique shoes</title>
  <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>

</head>
<!-- Style temporaire -->
<style>
  img {
    width: 100px;
    height: 100px;

  }
</style>

<body>

  <?php include 'header-display.php' ?>

  <div class="container_shoe">

    <div class="container_shoe_left">
      <h1>SHOE THE <br> RIGHT <span> ONE</span></h1>
      <button>See our store</button>
    </div>

    <div class="container_shoe_right">
      <img src="assets/style/img/shoe_one.png" alt=" a shoe">
      <h2>NIQUE</h2>
    </div>
      
  </div>

<h3><span>Our </span>last products</h3>

  <main>
    
    <?php

//get the information of the products from the json file
    $json_data = file_get_contents('assets/json/catalog.json');


    if ($json_data === false) {
      echo 'Error reading catalog data';
    } else {

      $catalog = json_decode($json_data, true);


      if ($catalog === null) {
        echo 'Error decoding catalog data';
      } else {
        //For each product in the catalog, display the image, the name, the price and a button to add it to the cart
        foreach ($catalog as $item) {
          echo '<img src="' . $item['image_url'] . '" alt="' . $item['product'] . '">';
          echo '<h2>' . $item['id'] . '</h2>';
          echo '<p class="name-shoe-main">' . $item['product'] . '</p>';
          echo '<p class="price-shoe-main">$' . $item['price'] . '</p>';
          echo '<form method="post">';
          echo '<input type="hidden" name="item_id" value="' . $item['id'] . '">';
          echo '<button type="submit" name="add_item" value="Add to cart">Add to cart</button>';
          echo '</form>';
          echo '<span class="span-main-shoe"></span>';
          // echo '<hr>';
          // echo '<pre>' . print_r($_SESSION) . '</pre>';
        }
      }
    };

    // check if the "Add to cart" button was clicked
    if (isset($_POST['add_item'])) {
      // get the item ID from the form
      $item_id = $_POST['item_id'];
      // check if the item is not already in the cart
      if (!isset($_SESSION['cart'][$item_id])) {
        // get the item data from the catalog
        $item = $catalog[$item_id];
        // add the item to the cart with a quantity of 1
        $_SESSION['cart'][$item_id] = array(
          'id' => $item['id'],
          'product' => $item['product'],
          'price' => $item['price'],
          'image_url' => $item['image_url'],
          //number is the quantity of the item in the cart
          'number' => 1
        );
        // if the item is already in the cart increase the quantity by 1
      } else { 
        $_SESSION['cart'][$item_id]['number']++;
      }
    }
    ?>
  </main>
  <picture>
    <img src="assets/style/img/shoe_two.png" alt=" a blurple shoe">
    <h2> WE PROVIDE YOU THE<span> BEST </span> QUALITY.</h2>
    <quote>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
      Vel est labore nobis sed excepturi ut alias porro sapiente aspernatur
      aliquam consequuntur voluptates, quos veritatis quibusdam?
    </quote>
  </picture>

  <div class="reviews">
    <div class="review_one">
      <img src="assets/style/img/image-emily.jpg" alt="Emily" class="img-emily">
      <h3>Emily from xyz</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
    </div>
    <div class="review_two">
      <img src="assets/style/img/image-thomas.jpg" alt="Thomas" class="img-thomas">
      <h3>Thomas from corporate</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
    </div>
    <div class="review_three">
      <img src="assets/style/img/image-jennie.jpg" alt="Jennie" class="img-jennie">
      <h3>Jennie from Nike</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
    </div>
  </div>
  <?php include 'footer-display.php' ?>
</body>

</html>