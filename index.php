<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nique shoes</title>
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

  <main>
    <?php
    session_start();

    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = [];
    }

    $json_data = file_get_contents('assets/json/catalog.json');


    if ($json_data === false) {
      echo 'Error reading catalog data';
    } else {

      $catalog = json_decode($json_data, true);


      if ($catalog === null) {
        echo 'Error decoding catalog data';
      } else {
        foreach ($catalog as $item) {
          echo '<img src="' . $item['image_url'] . '" alt="' . $item['product'] . '">';
          echo '<h2>' . $item['id'] . '</h2>';
          echo '<p>' . $item['product'] . '</p>';
          echo '<p>Price: $' . $item['price'] . '</p>';
          echo '<form method="post">';
          echo '<input type="hidden" name="item_id" value="' . $item['id'] . '">';
          echo '<button type="submit" name="add_item" value="Add to cart">Add to cart</button>';
          echo '</form>';
          echo '<hr>';
          echo '<pre>' . print_r($_SESSION) . '</pre>';
        }
      }
    };

    ?>
<?php
if (isset($_POST['add_item'])) {
  $item_id = $_POST['item_id'];
  if (!in_array($item_id, $_SESSION['cart'])) {
    $_SESSION['cart'][] = $item_id;
  }
}
?>
  </main>
  <picture>
    <img src="assets/style/img/shoe_two.png" alt=" a blurple shoe">
    <h1> WE PROVIDE YOU THE<span> BEST </span> QUALITY.</h1>
    <quote>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
      Vel est labore nobis sed excepturi ut alias porro sapiente aspernatur
      aliquam consequuntur voluptates, quos veritatis quibusdam?
    </quote>
  </picture>
  <?php include 'footer-display.php' ?>
</body>

</html>

<!-- echo '<form action="add_to_cart.php" method="post">';
        echo '<input type="hidden" name="item_id" value="' . $item['id'] . '">';
        echo '<button type="submit">Add to cart</button>'; -->