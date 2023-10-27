

<?php
echo '<header>
<p>Nique Store</p>
<nav class="nav_top"> 
<ul>
  <li><a href="index.php">Home</a></li>
  <li><a href="index.php">About</a></li>
  <li><a href="index.php">Product</a></li>
  <li><a href="index.php">Contact</a></li>
</ul>
</nav>
<a href="shopping-cart.php"><img src="./assets/style/img/shopping-cart.svg"></a>
</header>';

if (isset($_SESSION['cart'])) {
  $cartTotal = array_sum(array_column($_SESSION['cart'], 'number'));
  if ($cartTotal > 0) {
    echo '<span>' . $cartTotal . '</span>';
  } else {
    echo '<span style="display:none;"></span>';
  }
} else {
  echo '<span style="display:none;"></span>';
}
?>
