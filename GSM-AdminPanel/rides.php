<?php

include "connection.php";


// =============================
// DELETE MESSAGE
// =============================

$message = "";

if (isset($_GET['deleted'])) {
    $message = "Ride deleted successfully.";
}

if (isset($_GET['updated'])) {
    $message = "Ride updated successfully.";
}

if (isset($_GET['added'])) {
    $message = "Ride added successfully.";
}


// =============================
// GET ALL RIDES
// =============================

$query = "SELECT * FROM rides ORDER BY ride_date ASC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Manage Rides | Granite State Misfits</title>

    <link
        rel="stylesheet"
        href="./css/admin.css"
    >

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>

        .ride-page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .ride-page-header h1 {
            font-size: 27px;
            margin-bottom: 5px;
        }

        .ride-page-header p {
            color: #777;
            font-size: 13px;
        }

        .alert-success {
            background: #dcfce7;
            color: #15803d;
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .ride-thumb {
            width: 55px;
            height: 45px;
            object-fit: cover;
            border-radius: 6px;
            background: #eee;
        }

        .no-image {
            width: 55px;
            height: 45px;
            background: #111;
            color: #777;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
        }

        .ride-title-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .ride-title-cell strong {
            display: block;
            font-size: 12px;
        }

        .ride-title-cell small {
            display: block;
            color: #888;
            font-size: 9px;
            margin-top: 3px;
        }

        .btn-view {
            background: #f1f5f9;
            color: #334155;
        }

        .btn-view:hover {
            background: #e2e8f0;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state h3 {
            font-size: 18px;
            margin-bottom: 8px;
        }

        .empty-state p {
            color: #888;
            font-size: 12px;
            margin-bottom: 20px;
        }

        @media(max-width: 700px) {

            .ride-page-header {
                align-items: flex-start;
                gap: 15px;
                flex-direction: column;
            }

        }

    </style>

</head>


<body>
<div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    <?php include "header.php"; ?>

<main class="main">

    <div class="content">


        <!-- PAGE HEADER -->

        <div class="ride-page-header">

            <div>

                <h1>Manage Rides</h1>

                <p>
                    Add, view, edit and manage all motorcycle rides.
                </p>

            </div>


            <a
                href="add-ride.php"
                class="btn btn-red"
            >
                + Add New Ride
            </a>

        </div>


        <!-- SUCCESS MESSAGE -->

        <?php if ($message): ?>

            <div class="alert-success">

                <?= htmlspecialchars($message); ?>

            </div>

        <?php endif; ?>


        <!-- RIDES CARD -->

        <div class="card">

            <div class="card-header">

                <h2>All Rides</h2>

                <span style="font-size:11px;color:#888;">

                    <?= mysqli_num_rows($result); ?> rides

                </span>

            </div>


            <?php if (mysqli_num_rows($result) > 0): ?>


                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>Ride</th>

                                <th>Date</th>

                                <th>Start</th>

                                <th>Destination</th>

                                <th>Status</th>

                                <th>Actions</th>

                            </tr>

                        </thead>


                        <tbody>


                        <?php while ($ride = mysqli_fetch_assoc($result)): ?>


                            <tr>


                                <!-- RIDE -->

                                <td>

                                    <div class="ride-title-cell">


                                        <?php

                                        $image = $ride['ride_image'];

                                        if (!empty($image)):

                                        ?>

                                            <img
                                                src="Uploads/<?= htmlspecialchars($image); ?>"
                                                class="ride-thumb"
                                                alt="Ride"
                                            >

                                        <?php else: ?>

                                            <div class="no-image">
                                                NO IMAGE
                                            </div>

                                        <?php endif; ?>


                                        <div>

                                            <strong>

                                                <?= htmlspecialchars(
                                                    $ride['ride_name']
                                                ); ?>

                                            </strong>

                                            <small>

                                                ID:
                                                #<?= htmlspecialchars(
                                                    $ride['ride_id']
                                                ); ?>

                                            </small>

                                        </div>


                                    </div>

                                </td>


                                <!-- DATE -->

                                <td>

                                    <?= date(
                                        "M d, Y",
                                        strtotime($ride['ride_date'])
                                    ); ?>

                                </td>


                                <!-- START -->

                                <td>

                                    <?= htmlspecialchars(
                                        $ride['start_location']
                                    ); ?>

                                </td>


                                <!-- DESTINATION -->

                                <td>

                                    <?= htmlspecialchars(
                                        $ride['destination']
                                    ); ?>

                                </td>


                                <!-- STATUS -->

                                <td>


                                    <?php

                                    $status = strtolower(
                                        $ride['status']
                                    );

                                    ?>


                                    <?php if ($status == 'open'): ?>

                                        <span class="status open">
                                            Open
                                        </span>

                                    <?php elseif ($status == 'completed'): ?>

                                        <span class="status closed">
                                            Completed
                                        </span>

                                    <?php else: ?>

                                        <span class="status closed">

                                            <?= htmlspecialchars(
                                                $ride['status']
                                            ); ?>

                                        </span>

                                    <?php endif; ?>


                                </td>


                                <!-- ACTIONS -->

                                <td>

                                    <div class="actions">


                                        <!-- VIEW -->

                                        <a
                                            href="view-ride.php?id=<?= $ride['ride_id']; ?>"
                                            class="btn btn-view"
                                        >
                                            View
                                        </a>


                                        <!-- EDIT -->

                                        <a
                                            href="edit-ride.php?id=<?= $ride['ride_id']; ?>"
                                            class="btn btn-light"
                                        >
                                            Edit
                                        </a>


                                        <!-- DELETE -->

                                        <a
                                            href="delete-ride.php?id=<?= $ride['ride_id']; ?>"
                                            class="btn btn-danger"
                                            onclick="return confirm(
                                                'Are you sure you want to delete this ride?'
                                            );"
                                        >
                                            Delete
                                        </a>


                                    </div>

                                </td>


                            </tr>


                        <?php endwhile; ?>


                        </tbody>

                    </table>

                </div>


            <?php else: ?>


                <div class="empty-state">

                    <h3>No rides found</h3>

                    <p>
                        You haven't added any rides yet.
                    </p>

                    <a
                        href="add-ride.php"
                        class="btn btn-red"
                    >
                        + Add Your First Ride
                    </a>

                </div>


            <?php endif; ?>


        </div>


    </div>

</main>


</body>

</html>