<?php

include "connection.php";


// =====================================================
// CHECK RAFFLE ID
// =====================================================

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: raffle.php");
    exit;
}

$id = intval($_GET['id']);


// =====================================================
// FETCH RAFFLE
// =====================================================

$query = "SELECT * FROM raffles WHERE raffle_id = $id";

$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {

    echo "Raffle not found!";
    exit;
}

$raffle = mysqli_fetch_assoc($result);


// =====================================================
// UPDATE RAFFLE
// =====================================================

if (isset($_POST['update_raffle'])) {

    $title = mysqli_real_escape_string(
        $conn,
        $_POST['title']
    );

    $description = mysqli_real_escape_string(
        $conn,
        $_POST['description']
    );

    $prize = mysqli_real_escape_string(
        $conn,
        $_POST['prize']
    );

    $draw_date = mysqli_real_escape_string(
        $conn,
        $_POST['draw_date']
    );

    $status = mysqli_real_escape_string(
        $conn,
        $_POST['status']
    );


    // Existing image filename
    $image = $raffle['image'];


    // =================================================
    // NEW IMAGE
    // =================================================

    if (
        isset($_FILES['image']) &&
        $_FILES['image']['error'] == 0
    ) {

        $upload_dir = "Uploads/";

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }


        $original_name = $_FILES['image']['name'];

        $tmp_name = $_FILES['image']['tmp_name'];

        $extension = strtolower(
            pathinfo(
                $original_name,
                PATHINFO_EXTENSION
            )
        );


        $allowed_types = [
            'jpg',
            'jpeg',
            'png',
            'webp'
        ];


        if (in_array($extension, $allowed_types)) {

            $new_image = time() . "_" . basename(
                $original_name
            );


            $target_file = $upload_dir . $new_image;


            if (
                move_uploaded_file(
                    $tmp_name,
                    $target_file
                )
            ) {

                // Delete old image
                if (
                    !empty($raffle['image']) &&
                    file_exists(
                        $upload_dir . $raffle['image']
                    )
                ) {

                    unlink(
                        $upload_dir . $raffle['image']
                    );
                }


                // Store only filename in database
                $image = $new_image;
            }
        }
    }


    // =================================================
    // UPDATE QUERY
    // =================================================

    $update_query = "
        UPDATE raffles SET

            title = '$title',

            description = '$description',

            prize = '$prize',

            image = '$image',

            draw_date = '$draw_date',

            status = '$status'

        WHERE raffle_id = $id
    ";


    if (mysqli_query($conn, $update_query)) {

        header("Location: raffle.php?updated=1");
        exit;

    } else {

        $error = "Failed to update raffle: " . mysqli_error($conn);
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

    <title>Edit Raffle | Granite State Misfits</title>

    <link
        rel="stylesheet"
        href="./css/admin.css"
    >

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


        .edit-card {

            background: #fff;

            border: 1px solid #eee;

            border-radius: 12px;

            padding: 25px;
        }


        .form-row {

            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 20px;
        }


        .form-group {

            display: flex;

            flex-direction: column;
        }


        .form-group.full {

            grid-column: 1 / -1;
        }


        .form-group label {

            font-size: 11px;

            font-weight: 600;

            color: #555;

            margin-bottom: 7px;
        }


        .form-control,
        .form-select {

            width: 100%;

            border: 1px solid #ddd;

            border-radius: 7px;

            padding: 10px 12px;

            font-size: 12px;

            font-family: inherit;

            color: #333;

            background: #fff;

            outline: none;
        }


        .form-control:focus,
        .form-select:focus {

            border-color: #dc2626;

            box-shadow: none;
        }


        textarea.form-control {

            min-height: 130px;

            resize: vertical;
        }


        .current-image {

            width: 180px;

            height: 120px;

            object-fit: cover;

            border-radius: 8px;

            border: 1px solid #eee;

            display: block;
        }


        .no-image {

            width: 180px;

            height: 120px;

            border-radius: 8px;

            background: #f5f5f5;

            display: flex;

            align-items: center;

            justify-content: center;

            color: #888;

            font-size: 11px;
        }


        .help-text {

            font-size: 10px;

            color: #888;

            margin-top: 6px;
        }


        .form-actions {

            display: flex;

            gap: 7px;

            margin-top: 25px;
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


        .btn-update {

            background: #dc2626;

            color: #fff;
        }


        .btn-update:hover {

            background: #b91c1c;

            color: #fff;
        }


        .btn-cancel {

            background: #f1f1f1;

            color: #333;
        }


        .btn-cancel:hover {

            background: #e5e5e5;

            color: #333;
        }


        .alert {

            font-size: 11px;

            margin-bottom: 20px;

            border-radius: 7px;
        }


        @media (max-width: 700px) {

            .page-container {

                padding: 20px;
            }


            .page-heading {

                flex-direction: column;

                align-items: flex-start;

                gap: 15px;
            }


            .form-row {

                grid-template-columns: 1fr;
            }


            .form-group.full {

                grid-column: auto;
            }

        }

    </style>

</head>


<body>


<?php include "header.php"; ?>


<main class="main">


    <div class="page-container">


        <!-- PAGE HEADING -->

        <div class="page-heading">

            <div>

                <h1>Edit Raffle</h1>

                <p>
                    Update raffle information.
                </p>

            </div>


            <a
                href="raffles.php"
                class="btn btn-cancel"
            >
                ← Back to Raffles
            </a>

        </div>


        <!-- ERROR -->

        <?php if (isset($error)): ?>

            <div class="alert alert-danger">

                <?= htmlspecialchars($error); ?>

            </div>

        <?php endif; ?>


        <!-- EDIT CARD -->

        <div class="edit-card">


            <form
                method="POST"
                enctype="multipart/form-data"
            >


                <div class="form-row">


                    <!-- TITLE -->

                    <div class="form-group">

                        <label>
                            Raffle Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            value="<?= htmlspecialchars(
                                $raffle['title']
                            ); ?>"
                            required
                        >

                    </div>


                    <!-- PRIZE -->

                    <div class="form-group">

                        <label>
                            Prize
                        </label>

                        <input
                            type="text"
                            name="prize"
                            class="form-control"
                            value="<?= htmlspecialchars(
                                $raffle['prize']
                            ); ?>"
                            required
                        >

                    </div>


                    <!-- DRAW DATE -->

                    <div class="form-group">

                        <label>
                            Draw Date
                        </label>

                        <input
                            type="date"
                            name="draw_date"
                            class="form-control"
                            value="<?= htmlspecialchars(
                                $raffle['draw_date']
                            ); ?>"
                            required
                        >

                    </div>


                    <!-- STATUS -->

                    <div class="form-group">

                        <label>
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select"
                            required
                        >

                            <option
                                value="active"
                                <?= $raffle['status'] == 'active'
                                    ? 'selected'
                                    : ''; ?>
                            >
                                Active
                            </option>


                            <option
                                value="closed"
                                <?= $raffle['status'] == 'closed'
                                    ? 'selected'
                                    : ''; ?>
                            >
                                Closed
                            </option>


                            <option
                                value="completed"
                                <?= $raffle['status'] == 'completed'
                                    ? 'selected'
                                    : ''; ?>
                            >
                                Completed
                            </option>

                        </select>

                    </div>


                    <!-- DESCRIPTION -->

                    <div class="form-group full">

                        <label>
                            Description
                        </label>

                        <textarea
                            name="description"
                            class="form-control"
                            required
                        ><?= htmlspecialchars(
                            $raffle['description']
                        ); ?></textarea>

                    </div>


                    <!-- CURRENT IMAGE -->

                    <div class="form-group">

                        <label>
                            Current Image
                        </label>


                        <?php if (!empty($raffle['image'])): ?>

                            <img
                                src="Uploads/<?= htmlspecialchars(
                                    $raffle['image']
                                ); ?>"
                                class="current-image"
                                alt="Raffle Image"
                            >

                        <?php else: ?>

                            <div class="no-image">
                                No Image
                            </div>

                        <?php endif; ?>

                    </div>


                    <!-- CHANGE IMAGE -->

                    <div class="form-group">

                        <label>
                            Change Image
                        </label>

                        <input
                            type="file"
                            name="image"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <span class="help-text">
                            Leave empty to keep the current image.
                        </span>

                    </div>


                </div>


                <!-- BUTTONS -->

                <div class="form-actions">

                    <button
                        type="submit"
                        name="update_raffle"
                        class="btn btn-update"
                    >
                        Update Raffle
                    </button>


                    <a
                        href="raffle.php"
                        class="btn btn-cancel"
                    >
                        Cancel
                    </a>

                </div>


            </form>


        </div>


    </div>


</main>


</body>

</html>