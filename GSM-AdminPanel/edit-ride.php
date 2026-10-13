<?php

include "connection.php";


if (!isset($_GET['id'])) {

    header("Location: rides.php");

    exit;

}


$ride_id = intval($_GET['id']);


$result = mysqli_query(
    $conn,
    "SELECT * FROM rides WHERE ride_id = $ride_id"
);


if (!$result || mysqli_num_rows($result) == 0) {

    die("Ride not found.");

}


$ride = mysqli_fetch_assoc($result);


$error = "";


if (isset($_POST['update_ride'])) {


    $ride_name = mysqli_real_escape_string(
        $conn,
        $_POST['ride_name']
    );

    $ride_date = mysqli_real_escape_string(
        $conn,
        $_POST['ride_date']
    );

    $start_location = mysqli_real_escape_string(
        $conn,
        $_POST['start_location']
    );

    $destination = mysqli_real_escape_string(
        $conn,
        $_POST['destination']
    );

    $meeting_point = mysqli_real_escape_string(
        $conn,
        $_POST['meeting_point']
    );

    $departure_time = mysqli_real_escape_string(
        $conn,
        $_POST['departure_time']
    );

    $distance = mysqli_real_escape_string(
        $conn,
        $_POST['distance']
    );

    $estimated_duration = mysqli_real_escape_string(
        $conn,
        $_POST['estimated_duration']
    );

    $difficulty_level = mysqli_real_escape_string(
        $conn,
        $_POST['difficulty_level']
    );

    $description = mysqli_real_escape_string(
        $conn,
        $_POST['description']
    );

    $route = mysqli_real_escape_string(
        $conn,
        $_POST['route']
    );

    $requirements = mysqli_real_escape_string(
        $conn,
        $_POST['requirements']
    );

    $status = mysqli_real_escape_string(
        $conn,
        $_POST['status']
    );


    // Current image

    $image_name = $ride['ride_image'];


    // =============================
    // NEW IMAGE
    // =============================

    if (
        isset($_FILES['ride_image']) &&
        $_FILES['ride_image']['error'] == 0
    ) {


        $upload_dir = "Uploads/";


        $extension = strtolower(
            pathinfo(
                $_FILES['ride_image']['name'],
                PATHINFO_EXTENSION
            )
        );


        $allowed = [
            'jpg',
            'jpeg',
            'png',
            'webp'
        ];


        if (!in_array($extension, $allowed)) {

            $error =
                "Only JPG, JPEG, PNG and WEBP images are allowed.";

        } elseif (
            $_FILES['ride_image']['size'] >
            5 * 1024 * 1024
        ) {

            $error =
                "Image must be less than 5MB.";

        } else {


            // Delete old image

            if (
                !empty($ride['ride_image']) &&
                file_exists(
                    $upload_dir . $ride['ride_image']
                )
            ) {

                unlink(
                    $upload_dir . $ride['ride_image']
                );

            }


            $image_name =
                time() .
                "_" .
                uniqid() .
                "." .
                $extension;


            move_uploaded_file(

                $_FILES['ride_image']['tmp_name'],

                $upload_dir . $image_name

            );

        }

    }


    // =============================
    // UPDATE DATABASE
    // =============================

    if (empty($error)) {


        $query = "

            UPDATE rides SET

                ride_name = '$ride_name',

                ride_image = '$image_name',

                ride_date = '$ride_date',

                start_location = '$start_location',

                destination = '$destination',

                meeting_point = '$meeting_point',

                departure_time = '$departure_time',

                distance = '$distance',

                estimated_duration =
                    '$estimated_duration',

                difficulty_level =
                    '$difficulty_level',

                description = '$description',

                route = '$route',

                requirements = '$requirements',

                status = '$status'

            WHERE ride_id = $ride_id

        ";


        if (mysqli_query($conn, $query)) {

            header(
                "Location: rides.php?updated=1"
            );

            exit;

        } else {

            $error =
                mysqli_error($conn);

        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Ride</title>

    <link rel="stylesheet"
          href="./css/admin.css">

</head>

<body>

<?php include "header.php"; ?>


<main class="main">

    <div class="content">

        <div class="page-title">

            <h1>Edit Ride</h1>

            <p>
                Update the ride details below.
            </p>

        </div>


        <div class="card">

            <div class="card-body">

                <form method="POST">


                    <!-- RIDE NAME -->

                    <div class="form-group">

                        <label>Ride Name</label>

                        <input
                            type="text"
                            name="ride_name"
                            value="<?= htmlspecialchars($ride['ride_name']); ?>"
                            required
                        >

                    </div>


                    <!-- DATE -->

                    <div class="form-group">

                        <label>Ride Date</label>

                        <input
                            type="date"
                            name="ride_date"
                            value="<?= htmlspecialchars($ride['ride_date']); ?>"
                            required
                        >

                    </div>


                    <!-- START LOCATION -->

                    <div class="form-group">

                        <label>Start Location</label>

                        <input
                            type="text"
                            name="start_location"
                            value="<?= htmlspecialchars($ride['start_location']); ?>"
                            required
                        >

                    </div>


                    <!-- DESTINATION -->

                    <div class="form-group">

                        <label>Destination</label>

                        <input
                            type="text"
                            name="destination"
                            value="<?= htmlspecialchars($ride['destination']); ?>"
                        >

                    </div>


                    <!-- MEETING POINT -->

                    <div class="form-group">

                        <label>Meeting Point</label>

                        <input
                            type="text"
                            name="meeting_point"
                            value="<?= htmlspecialchars($ride['meeting_point']); ?>"
                        >

                    </div>


                    <!-- DEPARTURE -->

                    <div class="form-group">

                        <label>Departure Time</label>

                        <input
                            type="time"
                            name="departure_time"
                            value="<?= htmlspecialchars($ride['departure_time']); ?>"
                        >

                    </div>


                    <!-- DISTANCE -->

                    <div class="form-group">

                        <label>Distance</label>

                        <input
                            type="text"
                            name="distance"
                            value="<?= htmlspecialchars($ride['distance']); ?>"
                        >

                    </div>


                    <!-- DURATION -->

                    <div class="form-group">

                        <label>Estimated Duration</label>

                        <input
                            type="text"
                            name="estimated_duration"
                            value="<?= htmlspecialchars($ride['estimated_duration']); ?>"
                        >

                    </div>


                    <!-- DIFFICULTY -->

                    <div class="form-group">

                        <label>Difficulty Level</label>

                        <select name="difficulty_level">

                            <option value="Easy"
                                <?= $ride['difficulty_level'] == 'Easy' ? 'selected' : ''; ?>>
                                Easy
                            </option>

                            <option value="Moderate"
                                <?= $ride['difficulty_level'] == 'Moderate' ? 'selected' : ''; ?>>
                                Moderate
                            </option>

                            <option value="Hard"
                                <?= $ride['difficulty_level'] == 'Hard' ? 'selected' : ''; ?>>
                                Hard
                            </option>

                        </select>

                    </div>


                    <!-- DESCRIPTION -->

                    <div class="form-group">

                        <label>Description</label>

                        <textarea
                            name="description"
                            rows="5"
                        ><?= htmlspecialchars($ride['description']); ?></textarea>

                    </div>


                    <!-- ROUTE -->

                    <div class="form-group">

                        <label>Route</label>

                        <textarea
                            name="route"
                            rows="4"
                        ><?= htmlspecialchars($ride['route']); ?></textarea>

                    </div>


                    <!-- REQUIREMENTS -->

                    <div class="form-group">

                        <label>Requirements</label>

                        <textarea
                            name="requirements"
                            rows="4"
                        ><?= htmlspecialchars($ride['requirements']); ?></textarea>

                    </div>


                    <!-- STATUS -->

                    <div class="form-group">

                        <label>Status</label>

                        <select name="status">

                            

                            <option value="upcoming"
                                <?= $ride['status'] == 'upcoming' ? 'selected' : ''; ?>>
                                Upcoming
                            </option>

                            <option value="completed"
                                <?= $ride['status'] == 'completed' ? 'selected' : ''; ?>>
                                Completed
                            </option>

                        </select>

                    </div>


                    <div style="margin-top:20px;">

                        <button
                            type="submit"
                            name="update_ride"
                            class="btn btn-red">
                            Update Ride
                        </button>


                        <a
                            href="rides.php"
                            class="btn btn-light">
                            Cancel
                        </a>

                    </div>


                </form>

            </div>

        </div>

    </div>

</main>

</body>

</html>


<style>

    .form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 7px;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 11px 13px;
    border: 1px solid #ddd;
    border-radius: 7px;
    font-family: 'Poppins', sans-serif;
    font-size: 13px;
    outline: none;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: #dc2626;
}

.form-group textarea {
    resize: vertical;
}
</style>