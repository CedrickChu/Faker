<?php

require('vendor/autoload.php'); // Include the Faker library
$faker = Faker\Factory::create();
$conn = mysqli_connect("localhost", "root", "root", "faker");

if (!$conn) {
    die(mysqli_connect_error());
}

// Get the list of existing user IDs from the userAccount table
$userIds = [];
$result = mysqli_query($conn, "SELECT id FROM userAccount");

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $userIds[] = $row['id'];
    }
}

for ($i = 0; $i < 20; $i++) {
    $ccid = $faker->unique()->numberBetween(1000, 9999);
    $creditCardType = $faker->creditCardType;
    $creditCardNumber = $faker->creditCardNumber;
    $creditCardExpirationDate = $faker->dateTimeThisCentury->format('Y-m-d H:i:s');
    
    // Randomly select a user ID from the list of existing user IDs
    $userIdNumber = $userIds[array_rand($userIds)];

    $sql = "INSERT INTO cardDetail (ccid, creditCardType, creditCardNumber, creditCardExpirationDate, userIdNumber) VALUES ('$ccid', '$creditCardType', '$creditCardNumber', '$creditCardExpirationDate', '$userIdNumber')";
    mysqli_query($conn, $sql);
}
echo "20 rows of fake data have been inserted into the 'cardDetail' table.";

mysqli_close($conn);

?>
