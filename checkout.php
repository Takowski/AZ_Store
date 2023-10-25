<?php include 'add-to-cart.php' ?>
<?php
session_start();
// Initialize variables with empty values
$firstname =
    $lastname =
    $email =
    $address =
    $city =
    $zipcode =
    $country = "";
$firstnameErr =
    $lastnameErr =
    $emailErr =
    $addressErr =
    $cityErr =
    $zipcodeErr =
    $countryErr = "";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $firstname = sanitize_input($_POST["firstname"]);
    $lastname = sanitize_input($_POST["lastname"]);
    $email = sanitize_input($_POST["email"]);
    $address = sanitize_input($_POST["address"]);
    $city = sanitize_input($_POST["city"]);
    $zipcode = sanitize_input($_POST["zipcode"]);
    $country = sanitize_input($_POST["country"]);

    // Validate input data
    if (empty($firstname)) {
        $firstnameErr = "First name is required";
    }
    if (empty($lastname)) {
        $lastnameErr = "Last name is required";
    }
    if (empty($email)) {
        $emailErr = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }
    if (empty($address)) {
        $addressErr = "Address is required";
    }
    if (empty($city)) {
        $cityErr = "City is required";
    }
    if (empty($zipcode)) {
        $zipcodeErr = "Zip code is required";
    }
    if (empty($country)) {
        $countryErr = "Country is required";
    }

    // If there are no errors, submit the form
    if (empty($firstnameErr) && empty($lastnameErr) && empty($emailErr) && empty($addressErr) && empty($cityErr) && empty($zipcodeErr) && empty($countryErr)) {
        // Read the existing JSON data from the file
        $json_data = file_get_contents('assets/json/command.json');

        // Convert the JSON data to an array
        $data_array = json_decode($json_data, true);

        // Get the last command number and increment it
        $last_command_number = end($data_array)['command_number'];
        if ($last_command_number == null) {
            $command_number = 1;
        } else {
            $command_number = $last_command_number + 1;
        }

        // Create an array with the form data and the new command number
        $data = array(
            'command_number' => $command_number,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'address' => $address,
            'city' => $city,
            'zipcode' => $zipcode,
            'country' => $country
        );

        // Add the new data to the existing array
        array_push($data_array, $data);

        // Convert the array to JSON format
        $json_data = json_encode($data_array);

        // Write the JSON data to the file
        file_put_contents('assets/json/command.json', $json_data);

        // Redirect the user to a confirmation page
        header("Location: confirmation.php");
        exit();
    }
}

// Sanitize input data function
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="firstname">First Name:</label>
    <input type="text" id="firstname" name="firstname" value="<?php echo $firstname; ?>">
    <span class="error"><?php echo $firstnameErr; ?></span><br>

    <label for="lastname">Last Name:</label>
    <input type="text" id="lastname" name="lastname" value="<?php echo $lastname; ?>">
    <span class="error"><?php echo $lastnameErr; ?></span><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>">
    <span class="error"><?php echo $emailErr; ?></span><br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" value="<?php echo $address; ?>">
    <span class="error"><?php echo $addressErr; ?></span><br>

    <label for="city">City:</label>
    <input type="text" id="city" name="city" value="<?php echo $city; ?>">
    <span class="error"><?php echo $cityErr; ?></span><br>

    <label for="zipcode">Zip Code:</label>
    <input type="text" id="zipcode" name="zipcode" value="<?php echo $zipcode; ?>">
    <span class="error"><?php echo $zipcodeErr; ?></span><br>

    <label for="country">Country:</label>
    <input type="text" id="country" name="country" value="<?php echo $country; ?>">
    <span class="error"><?php echo $countryErr; ?></span><br>

    <input type="submit" value="Submit">
</form>
<?php include 'footer-display.php' ?>