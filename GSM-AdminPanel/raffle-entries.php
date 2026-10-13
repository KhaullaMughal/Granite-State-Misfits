<?php

include "connection.php";

$raffle_id = intval($_GET['id'] ?? 0);

$query = mysqli_query(
    $conn,
    "SELECT *
     FROM raffle_entries
     WHERE raffle_id = $raffle_id
     ORDER BY created_at DESC"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Raffle Entries | GSM</title>

    <link rel="stylesheet"
          href="./css/admin.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <style>

        .entries-card {
            background: white;
            border: 1px solid #eee;
            border-radius: 12px;
            overflow: hidden;
        }

        .entries-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .entries-header h2 {
            font-size: 17px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 800px;
            border-collapse: collapse;
        }

        th {
            background: #fafafa;
            color: #777;
            font-size: 10px;
            padding: 13px;
            text-align: left;
            text-transform: uppercase;
        }

        td {
            padding: 14px 13px;
            border-top: 1px solid #eee;
            font-size: 11px;
        }

        .entry-code {
            font-weight: 700;
            color: #dc2626;
        }

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 600;
        }

        .entered {
            background: #f1f1f1;
            color: #555;
        }

        .winner {
            background: #dcfce7;
            color: #15803d;
        }

    </style>

</head>

<body>

<?php include "header.php"; ?>

<main class="main">

    <div class="content">

        <div class="page-title">

            <h1>Raffle Entries</h1>

            <p>
                View everyone who entered the raffle.
            </p>

        </div>


        <div class="entries-card">

            <div class="entries-header">

                <h2>
                    All Entries
                </h2>

            </div>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>Entry Code</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Date</th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php if (mysqli_num_rows($query) > 0): ?>

                        <?php while ($entry = mysqli_fetch_assoc($query)): ?>

                            <tr>

                                <td class="entry-code">

                                    <?= htmlspecialchars(
                                        $entry['entry_code']
                                    ); ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $entry['name']
                                    ); ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $entry['email']
                                    ); ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $entry['phone']
                                    ); ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $entry['city']
                                    ); ?>

                                </td>

                                <td>

                                    <span class="status <?= $entry['status']; ?>">

                                        <?= htmlspecialchars(
                                            $entry['status']
                                        ); ?>

                                    </span>

                                </td>

                                <td>

                                    <?= date(
                                        "M d, Y",
                                        strtotime(
                                            $entry['created_at']
                                        )
                                    ); ?>

                                </td>

                            </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>

                            <td
                                colspan="7"
                                style="text-align:center;padding:40px;">

                                No entries yet.

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</main>

</body>

</html>