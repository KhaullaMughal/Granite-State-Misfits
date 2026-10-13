<?php

include "connection.php";

if (isset($_GET['id'])) {

    $message_id = intval($_GET['id']);

    mysqli_query(
        $conn,
        "UPDATE contact_messages
         SET status = 'Replied'
         WHERE message_id = $message_id"
    );
}

header("Location: contact-messages.php");
exit;

?>