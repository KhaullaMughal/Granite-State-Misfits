<?php

include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["admin_username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM admin 
            WHERE admin_username = '$username' 
            AND admin_password = '$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        header("Location: index.html");
        exit();

    } else {

        echo "Invalid username or password";

    }
}

?>