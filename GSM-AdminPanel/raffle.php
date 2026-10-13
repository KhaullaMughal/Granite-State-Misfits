<?php
include "connection.php";

$query = "SELECT * FROM raffles ORDER BY raffle_id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Raffles | Granite State Misfits</title>

    <link rel="stylesheet" href="./css/admin.css">

    <style>
        .page-container {
            padding: 30px;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-heading h1 {
            font-size: 27px;
            margin: 0;
        }

        .page-heading p {
            color: #777;
            font-size: 13px;
            margin-top: 5px;
        }

        .raffle-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 12px;
            overflow: hidden;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th {
            background: #fafafa;
            color: #777;
            font-size: 10px;
            text-transform: uppercase;
            padding: 15px;
            text-align: left;
        }

        td {
            padding: 15px;
            border-top: 1px solid #eee;
            font-size: 12px;
        }

        .raffle-title {
            font-weight: 600;
        }

        .raffle-image {
            width: 55px;
            height: 45px;
            object-fit: cover;
            border-radius: 6px;
        }

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .active {
            background: #dcfce7;
            color: #15803d;
        }

        .closed {
            background: #fee2e2;
            color: #dc2626;
        }

        .completed {
            background: #e5e7eb;
            color: #374151;
        }

        .actions {
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
            background: #f1f1f1;
            color: #333;
        }

        .btn-edit {
            background: #fff7ed;
            color: #c2410c;
        }

        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-add {
            background: #dc2626;
            color: white;
        }

        .btn-add:hover {
            background: #b91c1c;
            color: white;
        }
    </style>
</head>

<body>

<div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    <?php include "header.php"; ?>

<main class="main">

    <div class="page-container">

        <div class="page-heading">

            <div>
                <h1>Raffle Management</h1>
                <p>Create and manage your raffles.</p>
            </div>

            <a href="add-raffle.php" class="btn btn-add">
                + Add Raffle
            </a>

        </div>


        <div class="raffle-card">

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>
                            <th>Image</th>
                            <th>Raffle</th>
                            <th>Prize</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php if (mysqli_num_rows($result) > 0): ?>

                        <?php while ($raffle = mysqli_fetch_assoc($result)): ?>

                            <?php

                            $raffle_id = $raffle['raffle_id'];

                            $entry_query = mysqli_query(
                                $conn,
                                "SELECT COUNT(*) AS total
                                 FROM raffle_entries
                                 WHERE raffle_id = $raffle_id"
                            );

                            $entry_count = mysqli_fetch_assoc(
                                $entry_query
                            )['total'];

                            ?>

                            <tr>

                                <td>

                                    <?php if (!empty($raffle['image'])): ?>

                                        <img
                                            src="Uploads/<?= htmlspecialchars($raffle['image']); ?>"
                                            class="raffle-image"
                                        >

                                    <?php else: ?>

                                        No Image

                                    <?php endif; ?>

                                </td>


                                <td class="raffle-title">

                                    <?= htmlspecialchars(
                                        $raffle['title']
                                    ); ?>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $raffle['prize']
                                    ); ?>

                                </td>


                                <td>

                                    <span class="status <?= $raffle['status']; ?>">

                                        <?= htmlspecialchars(
                                            $raffle['status']
                                        ); ?>

                                    </span>

                                </td>


                                <td>

                                    <div class="actions">

                                        <a
                                            href="view-raffle.php?id=<?= $raffle_id; ?>"
                                            class="btn btn-view">
                                            View
                                        </a>

                                        <a
                                            href="edit-raffle.php?id=<?= $raffle_id; ?>"
                                            class="btn btn-edit">
                                            Edit
                                        </a>

                                        <a
                                            href="delete-raffle.php?id=<?= $raffle_id; ?>"
                                            class="btn btn-delete"
                                            onclick="return confirm('Are you sure you want to delete this raffle?');">
                                            Delete
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="8" style="text-align:center;">
                                No raffles found.
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