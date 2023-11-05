<?php
require('vendor/autoload.php');
$faker = Faker\Factory::create();
$servername = "localhost";
$username = "root";
$password = "root";
$database = "faker";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

for ($i = 0; $i <= 100; $i++) {
    $email = mysqli_real_escape_string($conn, $faker->email);
    $lastname = mysqli_real_escape_string($conn, $faker->lastName);
    $firstname = mysqli_real_escape_string($conn, $faker->firstName);
    $username = mysqli_real_escape_string($conn, $faker->userName);
    $password = mysqli_real_escape_string($conn, $faker->password);

    $sql = "INSERT INTO userAccount (email, lastname, firstname, username, password) 
            VALUES ('$email', '$lastname', '$firstname', '$username', '$password')";

    mysqli_query($conn, $sql);
}

echo "100 rows of fake data have been inserted into the 'userAccount' table.";

// Close the database connection
mysqli_close($conn);
?>
