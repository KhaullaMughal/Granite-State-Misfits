<?php

include 'GSM-AdminPanel/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get and clean form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Validate required fields
    if (empty($name) || empty($email) || empty($message)) {
        header("Location: contact.php?status=error");
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.php?status=invalid_email");
        exit;
    }

    // Insert into database
    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO contact_messages 
        (name, email, subject, message) 
        VALUES (?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $name,
        $email,
        $subject,
        $message
    );

    if (mysqli_stmt_execute($stmt)) {

        /*
         * ADMIN EMAIL
         * Change this to the actual email where
         * you want to receive contact messages.
         */
        $admin_email = "khaullamughal123@gmail.com";

        $email_subject = "New Contact Message: " . ($subject ?: "No Subject");

        $email_body = "
New contact message received from Granite State Misfits website.

Name: $name
Email: $email
Subject: $subject

Message:
$message
";

        $headers = "From: website@granitestatemisfits.com\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Send email
        mail(
            $admin_email,
            $email_subject,
            $email_body,
            $headers
        );

        mysqli_stmt_close($stmt);

        header("Location: contact.php?status=success");
        exit;

    } else {

        mysqli_stmt_close($stmt);

        header("Location: contact.php?status=error");
        exit;
    }
}
?>