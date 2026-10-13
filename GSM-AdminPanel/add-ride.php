<?php

include "connection.php";

$error = "";


// =============================
// FORM SUBMISSION
// =============================

if (isset($_POST['add_ride'])) {


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


    // =============================
    // IMAGE UPLOAD
    // =============================

    $image_name = "";


    if (
        isset($_FILES['ride_image']) &&
        $_FILES['ride_image']['error'] == 0
    ) {


        $upload_dir = "Uploads/";


        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }


        $file_name = $_FILES['ride_image']['name'];

        $file_tmp = $_FILES['ride_image']['tmp_name'];

        $file_size = $_FILES['ride_image']['size'];


        $extension = strtolower(
            pathinfo(
                $file_name,
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

            $error = "Only JPG, JPEG, PNG and WEBP images are allowed.";

        } elseif ($file_size > 5 * 1024 * 1024) {

            $error = "Image size must be less than 5MB.";

        } else {


            $image_name =
                time() . "_" .
                uniqid() . "." .
                $extension;


            move_uploaded_file(
                $file_tmp,
                $upload_dir . $image_name
            );

        }

    }


    // =============================
    // INSERT
    // =============================

    if (empty($error)) {


        $query = "

            INSERT INTO rides (

                ride_name,
                ride_image,
                ride_date,
                start_location,
                destination,
                meeting_point,
                departure_time,
                distance,
                estimated_duration,
                difficulty_level,
                description,
                route,
                requirements,
                status

            )

            VALUES (

                '$ride_name',
                '$image_name',
                '$ride_date',
                '$start_location',
                '$destination',
                '$meeting_point',
                '$departure_time',
                '$distance',
                '$estimated_duration',
                '$difficulty_level',
                '$description',
                '$route',
                '$requirements',
                '$status'

            )

        ";


        if (mysqli_query($conn, $query)) {

            header("Location: rides.php?added=1");
            exit;

        } else {

            $error =
                "Database error: " .
                mysqli_error($conn);

        }

    }

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

    <title>Add Ride</title>

    <link
        rel="stylesheet"
        href="./css/admin.css"
    >

    <style>

        .form-grid {

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 18px;

        }

        .form-group {
            margin-bottom: 5px;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .form-group label {

            display: block;

            font-size: 12px;

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

            font-family: Poppins, sans-serif;

            font-size: 12px;

            outline: none;

        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {

            border-color: #dc2626;

        }

        textarea {
            resize: vertical;
        }

        .error {

            background: #fee2e2;

            color: #b91c1c;

            padding: 12px;

            border-radius: 7px;

            margin-bottom: 20px;

            font-size: 12px;

        }

        @media(max-width:700px) {

            .form-grid {
                grid-template-columns: 1fr;
            }

            .full-width {
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

            <h1>Add New Ride</h1>

            <p>
                Create a new motorcycle ride.
            </p>

        </div>


        <?php if ($error): ?>

            <div class="error">

                <?= htmlspecialchars($error); ?>

            </div>

        <?php endif; ?>


        <div class="card">

            <div class="card-body">


                <form
                    method="POST"
                    enctype="multipart/form-data"
                >


                    <div class="form-grid">


                        <div class="form-group">

                            <label>Ride Name *</label>

                            <input
                                type="text"
                                name="ride_name"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label>Ride Date *</label>

                            <input
                                type="date"
                                name="ride_date"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label>Start Location *</label>

                            <input
                                type="text"
                                name="start_location"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label>Destination *</label>

                            <input
                                type="text"
                                name="destination"
                                required
                            >

                        </div>


                        <div class="form-group">

                            <label>Meeting Point</label>

                            <input
                                type="text"
                                name="meeting_point"
                            >

                        </div>


                        <div class="form-group">

                            <label>Departure Time</label>

                            <input
                                type="time"
                                name="departure_time"
                            >

                        </div>


                        <div class="form-group">

                            <label>Distance</label>

                            <input
                                type="text"
                                name="distance"
                                placeholder="e.g. 120 miles"
                            >

                        </div>


                        <div class="form-group">

                            <label>Estimated Duration</label>

                            <input
                                type="text"
                                name="estimated_duration"
                                placeholder="e.g. 3 hours"
                            >

                        </div>


                        <div class="form-group">

                            <label>Difficulty Level</label>

                            <select name="difficulty_level">

                                <option value="Easy">
                                    Easy
                                </option>

                                <option value="Moderate">
                                    Moderate
                                </option>

                                <option value="Hard">
                                    Hard
                                </option>

                            </select>

                        </div>


                        <div class="form-group">

                            <label>Status</label>

                            <select name="status">

                                <option value="upcoming">
                                    upcoming
                                </option>

                                <option value="completed">
                                    completed
                                </option>

                            </select>

                        </div>


                        <div class="form-group full-width">

                            <label>Ride Image</label>

                            <input
                                type="file"
                                name="ride_image"
                                accept="image/jpeg,image/png,image/webp"
                            >

                            <small style="color:#888;">
                                JPG, PNG or WEBP. Maximum 5MB.
                            </small>

                        </div>


                        <div class="form-group full-width">

                            <label>Description</label>

                            <textarea
                                name="description"
                                rows="5"
                            ></textarea>

                        </div>


                        <div class="form-group full-width">

                            <label>Route</label>

                            <textarea
                                name="route"
                                rows="4"
                            ></textarea>

                        </div>


                        <div class="form-group full-width">

                            <label>Requirements</label>

                            <textarea
                                name="requirements"
                                rows="4"
                            ></textarea>

                        </div>


                    </div>


                    <div style="margin-top:25px;">

                        <button
                            type="submit"
                            name="add_ride"
                            class="btn btn-red"
                        >
                            Add Ride
                        </button>


                        <a
                            href="rides.php"
                            class="btn btn-light"
                        >
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