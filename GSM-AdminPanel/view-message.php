<?php

include "connection.php";

if (!isset($_GET['id'])) {
    header("Location: contact-messages.php");
    exit;
}

$message_id = intval($_GET['id']);

$query = mysqli_query(
    $conn,
    "SELECT *
     FROM contact_messages
     WHERE message_id = $message_id"
);

if (mysqli_num_rows($query) == 0) {
    header("Location: contact-messages.php");
    exit;
}

$message = mysqli_fetch_assoc($query);


// Mark as read automatically
if ($message['status'] == 'Unread') {

    mysqli_query(
        $conn,
        "UPDATE contact_messages
         SET status = 'Read'
         WHERE message_id = $message_id"
    );

    $message['status'] = 'Read';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>View Message | Granite State Misfits</title>

    <link rel="stylesheet" href="./css/admin.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <style>

        .message-card {
            background: white;
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 30px;
            max-width: 900px;
        }

        .message-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }

        .sender-info h2 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .sender-info a {
            color: #dc2626;
            font-size: 12px;
        }

        .subject-title {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .message-content {
            background: #fafafa;
            border-radius: 8px;
            padding: 20px;
            line-height: 1.8;
            font-size: 13px;
            white-space: pre-wrap;
        }

        .message-date {
            color: #888;
            font-size: 10px;
        }

        .message-buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            padding: 10px 15px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            font-size: 11px;
            font-weight: 600;
        }

        .btn-red {
            background: #dc2626;
            color: white;
        }

        .btn-dark {
            background: #111;
            color: white;
        }

        .btn-light {
            background: #eee;
            color: #333;
        }

    </style>

</head>

<body>

<?php include "header.php"; ?>

<main class="main">

    <div class="content">

        <div class="page-title">

            <h1>View Message</h1>

            <p>
                Read and manage visitor message.
            </p>

        </div>


        <div class="message-card">

            <div class="message-top">

                <div class="sender-info">

                    <h2>
                        <?= htmlspecialchars(
                            $message['name']
                        ); ?>
                    </h2>

                    <a href="mailto:<?= htmlspecialchars(
                        $message['email']
                    ); ?>">

                        <?= htmlspecialchars(
                            $message['email']
                        ); ?>

                    </a>

                </div>


                <div class="message-date">

                    <?= date(
                        "M d, Y h:i A",
                        strtotime($message['created_at'])
                    ); ?>

                </div>

            </div>


            <h3 class="subject-title">

                <?= htmlspecialchars(
                    $message['subject'] ?: 'No Subject'
                ); ?>

            </h3>


            <div class="message-content">

                <?= htmlspecialchars(
                    $message['message']
                ); ?>

            </div>


            <div class="message-buttons">

                <a
                    href="mailto:<?= htmlspecialchars($message['email']); ?>"
                    class="btn btn-red">

                    Reply via Email

                </a>


                <a
                    href="mark-replied.php?id=<?= $message['message_id']; ?>"
                    class="btn btn-dark">

                    Mark as Replied

                </a>


                <a
                    href="contact-messages.php"
                    class="btn btn-light">

                    Back to Messages

                </a>

            </div>

        </div>

    </div>

</main>

</body>

</html>