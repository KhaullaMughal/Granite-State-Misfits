<?php

include "connection.php";

// Get all contact messages
$query = "
    SELECT *
    FROM contact_messages
    ORDER BY created_at DESC
";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Contact Messages | Granite State Misfits</title>

    <link rel="stylesheet" href="./css/admin.css">

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <style>

        .messages-container {
            background: white;
            border: 1px solid #eee;
            border-radius: 12px;
            overflow: hidden;
        }

        .message-header {
            padding: 20px 22px;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .message-header h2 {
            font-size: 18px;
            margin: 0;
        }

        .message-count {
            background: #fee2e2;
            color: #dc2626;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .message-table {
            width: 100%;
            border-collapse: collapse;
        }

        .message-table th {
            background: #fafafa;
            color: #777;
            font-size: 10px;
            text-transform: uppercase;
            padding: 14px;
            text-align: left;
        }

        .message-table td {
            padding: 15px 14px;
            border-top: 1px solid #eee;
            font-size: 12px;
        }

        .sender {
            font-weight: 600;
        }

        .email {
            color: #888;
            font-size: 10px;
        }

        .subject {
            font-weight: 500;
        }

        .message-preview {
            max-width: 300px;
            color: #777;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .message-status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 600;
        }

        .unread {
            background: #fee2e2;
            color: #dc2626;
        }

        .read {
            background: #f1f1f1;
            color: #555;
        }

        .replied {
            background: #dcfce7;
            color: #15803d;
        }

        .message-actions {
            display: flex;
            gap: 5px;
        }

        .btn {
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-view {
            background: #111;
            color: white;
        }

        .btn-view:hover {
            background: #dc2626;
            color: white;
        }

        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
        }

        .empty-message {
            padding: 50px;
            text-align: center;
            color: #888;
        }

        @media(max-width: 800px) {

            .message-table {
                min-width: 900px;
            }

            .messages-container {
                overflow-x: auto;
            }

        }

    </style>

</head>

<body>
<div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    <?php include "header.php"; ?>


<main class="main">

    <div class="content">

        <div class="page-title">

            <h1>Contact Messages</h1>

            <p>
                Manage messages received from your website visitors.
            </p>

        </div>


        <div class="messages-container">

            <div class="message-header">

                <h2>All Messages</h2>

                <?php

                $unread_query = mysqli_query(
                    $conn,
                    "SELECT COUNT(*) AS total
                     FROM contact_messages
                     WHERE status = 'Unread'"
                );

                $unread = mysqli_fetch_assoc(
                    $unread_query
                )['total'];

                ?>

                <span class="message-count">

                    <?= $unread; ?> Unread

                </span>

            </div>


            <?php if (mysqli_num_rows($result) > 0): ?>

                <table class="message-table">

                    <thead>

                        <tr>

                            <th>Sender</th>

                            <th>Subject</th>

                            <th>Message</th>

                            <th>Status</th>

                            <th>Date</th>

                            <th>Actions</th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php while ($row = mysqli_fetch_assoc($result)): ?>

                        <tr>

                            <td>

                                <div class="sender">

                                    <?= htmlspecialchars(
                                        $row['name']
                                    ); ?>

                                </div>

                                <div class="email">

                                    <?= htmlspecialchars(
                                        $row['email']
                                    ); ?>

                                </div>

                            </td>


                            <td>

                                <div class="subject">

                                    <?= htmlspecialchars(
                                        $row['subject'] ?: 'No Subject'
                                    ); ?>

                                </div>

                            </td>


                            <td>

                                <div class="message-preview">

                                    <?= htmlspecialchars(
                                        $row['message']
                                    ); ?>

                                </div>

                            </td>


                            <td>

                                <?php

                                $status_class = strtolower(
                                    $row['status']
                                );

                                ?>

                                <span class="message-status <?= $status_class; ?>">

                                    <?= htmlspecialchars(
                                        $row['status']
                                    ); ?>

                                </span>

                            </td>


                            <td>

                                <?= date(
                                    "M d, Y",
                                    strtotime($row['created_at'])
                                ); ?>

                            </td>


                            <td>

                                <div class="message-actions">

                                    <a
                                        href="view-message.php?id=<?= $row['message_id']; ?>"
                                        class="btn btn-view">
                                        View
                                    </a>

                                    <a
                                        href="delete-message.php?id=<?= $row['message_id']; ?>"
                                        class="btn btn-delete"
                                        onclick="return confirm('Delete this message?');">
                                        Delete
                                    </a>

                                </div>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                    </tbody>

                </table>

            <?php else: ?>

                <div class="empty-message">

                    <h3>No Messages Yet</h3>

                    <p>
                        Contact form messages will appear here.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </div>

</main>

<script src="js/admin.js"></script>

</body>

</html>