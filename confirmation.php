
<?php
// Read the contents of the command.json file
$commandData = file_get_contents('assets/json/command.json');

// Convert the JSON data into a PHP array
$commandArray = json_decode($commandData, true);

// Get the last element of the array
$lastCommand = end($commandArray);

?>
<h1>Thank you for your order!</h1>

<p>command number: <?php echo $lastCommand['command_number']; ?></p>
<p>First Name: <?php echo $lastCommand['firstname']; ?></p>
<p>Last Name: <?php echo $lastCommand['lastname']; ?></p>
<p>Email: <?php echo $lastCommand['email']; ?></p>
<p>Address: <?php echo $lastCommand['address']; ?></p>
<p>City: <?php echo $lastCommand['city']; ?></p>
<p>Zip Code: <?php echo $lastCommand['zipcode']; ?></p>
<p>Country: <?php echo $lastCommand['country']; ?></p>
<p>Total cart: <?php echo $lastCommand['total cart']; ?></p>
<p>Vat <?php echo $lastCommand['vat_rate']; ?>% : <?php echo $lastCommand['total cart'] * $lastCommand['vat_rate'] / 100?> </p> 
<p>Price: <?php echo $lastCommand['price']; ?></p>



<p>Your order has been received and will be processed shortly.</p>
<p> we start the process as soon as we receive your payment , so we are unable to make any changes or modifications to an order after it has been placed and confirmed.</p>
<p>Once your order has been shipped, you will receive an email with your tracking and shipping information.</p>
<p>Thank you for shopping with us!</p>


<a href="/index.php" class="button">Return to homepage</a>

<?php include 'footer-display.php'; ?>