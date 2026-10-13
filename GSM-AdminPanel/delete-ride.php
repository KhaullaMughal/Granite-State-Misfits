<?php

include "connection.php";


if (!isset($_GET['id'])) {

    header("Location: rides.php");

    exit;

}


$ride_id = intval($_GET['id']);


// Get ride first

$result = mysqli_query(
    $conn,
    "SELECT ride_image FROM rides WHERE ride_id = $ride_id"
);


if (
    $result &&
    mysqli_num_rows($result) > 0
) {


    $ride = mysqli_fetch_assoc($result);


    // Delete image

    if (!empty($ride['ride_image'])) {


        $image_path =
            "Uploads/" .
            $ride['ride_image'];


        if (file_exists($image_path)) {

            unlink($image_path);

        }

    }


    // Delete database record

    $delete = mysqli_query(
        $conn,
        "DELETE FROM rides WHERE ride_id = $ride_id"
    );


    if ($delete) {

        header(
            "Location: rides.php?deleted=1"
        );

        exit;

    }


    die(
        "Unable to delete ride: " .
        mysqli_error($conn)
    );

}


header("Location: rides.php");

exit;

?>