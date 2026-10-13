<?php

include "connection.php";


if (!isset($_GET['id'])) {

    header("Location: gallery.php");

    exit;
}


$gallery_id = intval($_GET['id']);


// Get image first

$result = mysqli_query(
    $conn,
    "SELECT image_name FROM gallery
     WHERE gallery_id = $gallery_id"
);


if (
    $result &&
    mysqli_num_rows($result) > 0
) {


    $image = mysqli_fetch_assoc($result);


    // =============================
    // DELETE PHYSICAL IMAGE
    // =============================

    if (!empty($image['image_name'])) {


        $image_path =
            "Uploads/Gallery/" .
            $image['image_name'];


        if (file_exists($image_path)) {

            unlink($image_path);

        }

    }


    // =============================
    // DELETE DATABASE RECORD
    // =============================

    $delete = mysqli_query(
        $conn,
        "DELETE FROM gallery
         WHERE gallery_id = $gallery_id"
    );


    if ($delete) {

        header(
            "Location: gallery.php?deleted=1"
        );

        exit;

    }


    die(
        "Unable to delete image: " .
        mysqli_error($conn)
    );

}


header("Location: gallery.php");

exit;

?>