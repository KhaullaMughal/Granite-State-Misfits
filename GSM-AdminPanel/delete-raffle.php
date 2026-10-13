<?php

include "connection.php";

if (!isset($_GET['id'])) {
    header("Location: raffle.php");
    exit;
}

$id = intval($_GET['id']);


/* Get image */

$result = mysqli_query(
    $conn,
    "SELECT image
     FROM raffles
     WHERE raffle_id = $id"
);

$raffle = mysqli_fetch_assoc($result);


if (!$raffle) {

    header("Location: raffle.php");
    exit;

}


/* Delete raffle */

$stmt = $conn->prepare(
    "DELETE FROM raffles
     WHERE raffle_id = ?"
);

$stmt->bind_param("i", $id);

if ($stmt->execute()) {

    /* Delete image */

    if (!empty($raffle['image'])) {

        $image_path =
            "Uploads/" . $raffle['image'];

        if (file_exists($image_path)) {
            unlink($image_path);
        }

    }

}


header("Location: raffle.php");
exit;

?>