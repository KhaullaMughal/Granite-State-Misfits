<?php

include "../Rideweb/GSM-AdminPanel/connection.php";

echo "<h3>Database Test</h3>";

echo "Database: ";

$db = mysqli_query($conn, "SELECT DATABASE() AS db");

if (!$db) {
    die(mysqli_error($conn));
}

$db_row = mysqli_fetch_assoc($db);

echo "<strong>" . $db_row['db'] . "</strong><br><br>";

echo "Tables:<br>";

$tables = mysqli_query($conn, "SHOW TABLES");

while ($table = mysqli_fetch_array($tables)) {
    echo $table[0] . "<br>";
}

echo "<hr>";

echo "Raffles:<br>";

$result = mysqli_query($conn, "SELECT * FROM raffles");

if (!$result) {
    die("Raffle query error: " . mysqli_error($conn));
}

echo "Rows found: <strong>" . mysqli_num_rows($result) . "</strong><br><br>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<pre>";
    print_r($row);
    echo "</pre>";
}
?>