<?php

include "connection.php";


if (!isset($_GET['id'])) {

    header("Location: rides.php");

    exit;

}


$ride_id = intval($_GET['id']);


$query = "
    SELECT *
    FROM rides
    WHERE ride_id = $ride_id
";


$result = mysqli_query($conn, $query);


if (!$result || mysqli_num_rows($result) == 0) {

    die("Ride not found.");

}


$ride = mysqli_fetch_assoc($result);

?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        <?= htmlspecialchars($ride['ride_name']); ?>
    </title>

    <link
        rel="stylesheet"
        href="./css/admin.css"
    >

    <style>

        .ride-detail-image {

            width: 100%;

            height: 320px;

            object-fit: cover;

            border-radius: 10px;

            margin-bottom: 25px;

        }

        .detail-grid {

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 18px;

        }

        .detail-item {

            padding: 15px;

            background: #fafafa;

            border-radius: 8px;

            border: 1px solid #eee;

        }

        .detail-item.full {

            grid-column: 1 / -1;

        }

        .detail-item label {

            display: block;

            color: #888;

            font-size: 10px;

            text-transform: uppercase;

            margin-bottom: 5px;

        }

        .detail-item strong {

            font-size: 13px;

        }

        .description-box {

            white-space: pre-line;

            line-height: 1.7;

            font-size: 13px;

            color: #444;

        }

        @media(max-width:700px) {

            .detail-grid {

                grid-template-columns: 1fr;

            }

            .detail-item.full {

                grid-column: auto;

            }

        }

    </style>

</head>


<body>


<?php include "header.php"; ?>


<main class="main">

    <div class="content">


        <div class="page-title">

            <h1>
                <?= htmlspecialchars($ride['ride_name']); ?>
            </h1>

            <p>
                Ride ID #<?= $ride['ride_id']; ?>
            </p>

        </div>


        <div class="card">

            <div class="card-body">


                <?php if (!empty($ride['ride_image'])): ?>

                    <img
                        src="Uploads/<?= htmlspecialchars(
                            $ride['ride_image']
                        ); ?>"
                        class="ride-detail-image"
                        alt="Ride image"
                    >

                <?php endif; ?>


                <div class="detail-grid">


                    <div class="detail-item">

                        <label>Ride Date</label>

                        <strong>

                            <?= date(
                                "F d, Y",
                                strtotime($ride['ride_date'])
                            ); ?>

                        </strong>

                    </div>


                    <div class="detail-item">

                        <label>Status</label>

                        <strong>

                            <?= htmlspecialchars(
                                $ride['status']
                            ); ?>

                        </strong>

                    </div>


                    <div class="detail-item">

                        <label>Start Location</label>

                        <strong>

                            <?= htmlspecialchars(
                                $ride['start_location']
                            ); ?>

                        </strong>

                    </div>


                    <div class="detail-item">

                        <label>Destination</label>

                        <strong>

                            <?= htmlspecialchars(
                                $ride['destination']
                            ); ?>

                        </strong>

                    </div>


                    <div class="detail-item">

                        <label>Meeting Point</label>

                        <strong>

                            <?= htmlspecialchars(
                                $ride['meeting_point']
                            ); ?>

                        </strong>

                    </div>


                    <div class="detail-item">

                        <label>Departure Time</label>

                        <strong>

                            <?= htmlspecialchars(
                                $ride['departure_time']
                            ); ?>

                        </strong>

                    </div>


                    <div class="detail-item">

                        <label>Distance</label>

                        <strong>

                            <?= htmlspecialchars(
                                $ride['distance']
                            ); ?>

                        </strong>

                    </div>


                    <div class="detail-item">

                        <label>Estimated Duration</label>

                        <strong>

                            <?= htmlspecialchars(
                                $ride['estimated_duration']
                            ); ?>

                        </strong>

                    </div>


                    <div class="detail-item">

                        <label>Difficulty</label>

                        <strong>

                            <?= htmlspecialchars(
                                $ride['difficulty_level']
                            ); ?>

                        </strong>

                    </div>


                    <div class="detail-item full">

                        <label>Description</label>

                        <div class="description-box">

                            <?= htmlspecialchars(
                                $ride['description']
                            ); ?>

                        </div>

                    </div>


                    <div class="detail-item full">

                        <label>Route</label>

                        <div class="description-box">

                            <?= htmlspecialchars(
                                $ride['route']
                            ); ?>

                        </div>

                    </div>


                    <div class="detail-item full">

                        <label>Requirements</label>

                        <div class="description-box">

                            <?= htmlspecialchars(
                                $ride['requirements']
                            ); ?>

                        </div>

                    </div>


                </div>


                <div style="margin-top:25px;">

                    <a
                        href="edit-ride.php?id=<?= $ride['ride_id']; ?>"
                        class="btn btn-red"
                    >
                        Edit Ride
                    </a>

                    <a
                        href="rides.php"
                        class="btn btn-light"
                    >
                        Back to Rides
                    </a>

                </div>


            </div>

        </div>


    </div>

</main>


</body>

</html>