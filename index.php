<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nique shoes</title>
</head>


<body>
  <?php include 'header-display.php' ?>
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
          echo '<p>' . $item['product'] . '</p>';
          echo '<p>Price: $' . $item['price'] . '</p>';
          echo '<button type="submit">Add to cart</button>';
          echo '<hr>';
        }
      }
    }
    ?>
  </main>
</body>

</html>

<!-- echo '<form action="add_to_cart.php" method="post">';
        echo '<input type="hidden" name="item_id" value="' . $item['id'] . '">';
        echo '<button type="submit">Add to cart</button>'; -->