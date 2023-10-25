<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping cart of NIQUE</title>
</head>
<body>
  <?php include 'header-display.php' ?>
  <main>
    <?php
  ob_start();
  $jsonFile = './assets/json/cart.json';
   function createItem ($json, $id) {
    $json = file_get_contents($jsonFile);
    $json = json_decode($json, true);
    $item = $json[$id];
    return $item;
   };

   function shoppingCart () {
    ob_clean();
    $json = file_get_contents($jsonFile);
    $json = json_decode($json, true);
    $total = 0;
   };
    ?>
  </main>

</body>
</html>