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
    session_start();

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
          echo '<p class="name-shoe-main">' . $item['product'] . '</p>';
          echo '<p class="price-shoe-main"> $' . $item['price'] . '</p>';
          echo '<div id="add-to-cart-' . $item['id'] . '">';
          echo '<button type="submit" name="add_item" value="' . $item['id'] . '">Add to cart</button>';
          echo '<hr>';
        }
      }
    };
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

<!-- echo '<form action="add_to_cart.php" method="post">';
        echo '<input type="hidden" name="item_id" value="' . $item['id'] . '">';
        echo '<button type="submit">Add to cart</button>'; -->