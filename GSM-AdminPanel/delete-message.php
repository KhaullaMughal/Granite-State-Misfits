<?php

include "connection.php";

if (isset($_GET['id'])) {

    $message_id = intval($_GET['id']);

    mysqli_query(
        $conn,
        "DELETE FROM contact_messages
         WHERE message_id = $message_id"
    );
}

header("Location: contact-messages.php");
exit;

?>