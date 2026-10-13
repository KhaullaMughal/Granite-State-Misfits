<?php

include 'GSM-AdminPanel/connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: raffle.php");
    exit;
}

$raffle_id = intval($_POST['raffle_id'] ?? 0);

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$city = trim($_POST['city'] ?? '');


// Validate
if (
    $raffle_id <= 0 ||
    empty($name) ||
    empty($email)
) {
    header("Location: raffle.php?status=error#enter-raffle");
    exit;
}


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: raffle.php?status=error#enter-raffle");
    exit;
}


// Check raffle exists and is active
$stmt = $conn->prepare("
    SELECT raffle_id
    FROM raffles
    WHERE raffle_id = ?
    AND status = 'active'
");

$stmt->bind_param("i", $raffle_id);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {

    header("Location: raffle.php?status=error#enter-raffle");
    exit;
}

$stmt->close();


// Check duplicate email
$stmt = $conn->prepare("
    SELECT entry_id
    FROM raffle_entries
    WHERE raffle_id = ?
    AND email = ?
");

$stmt->bind_param(
    "is",
    $raffle_id,
    $email
);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $stmt->close();

    header("Location: raffle.php?status=exists#enter-raffle");
    exit;
}

$stmt->close();


// Generate unique entry code
$entry_code = 'GSM-' . strtoupper(
    substr(bin2hex(random_bytes(5)), 0, 8)
);


// Insert entry
$stmt = $conn->prepare("
    INSERT INTO raffle_entries
    (
        raffle_id,
        name,
        email,
        phone,
        city,
        entry_code
    )
    VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "isssss",
    $raffle_id,
    $name,
    $email,
    $phone,
    $city,
    $entry_code
);


if ($stmt->execute()) {

    /*
     * Send confirmation email.
     * SMTP/PHPMailer can be added later for reliable delivery.
     */

    $admin_email = "granitestatemisfitsnh@gmail.com";

    $subject = "New Raffle Entry - " . $entry_code;

    $body = "
New raffle entry received.

Name: $name
Email: $email
Phone: $phone
City: $city

Entry Code: $entry_code
";

    $headers = "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    @mail(
        $admin_email,
        $subject,
        $body,
        $headers
    );


    $stmt->close();

    header("Location: raffle.php?status=success#enter-raffle");
    exit;

}


$stmt->close();

header("Location: raffle.php?status=error#enter-raffle");
exit;

?>