<?php

include "connection.php";

if (!isset($_GET['id'])) {
    header("Location: gallery.php");
    exit;
}

$gallery_id = intval($_GET['id']);

$result = mysqli_query(
    $conn,
    "SELECT * FROM gallery WHERE gallery_id = $gallery_id"
);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Gallery image not found.");
}

$image = mysqli_fetch_assoc($result);

$error = "";


// =============================
// UPDATE GALLERY
// =============================

if (isset($_POST['update_gallery'])) {

    $title = mysqli_real_escape_string(
        $conn,
        $_POST['title']
    );

    $description = mysqli_real_escape_string(
        $conn,
        $_POST['description']
    );

    $status = mysqli_real_escape_string(
        $conn,
        $_POST['status']
    );

    // Keep old image
    $image_name = $image['image_name'];


    // =============================
    // NEW IMAGE
    // =============================

    if (
        isset($_FILES['gallery_image']) &&
        $_FILES['gallery_image']['error'] == 0
    ) {

        $upload_dir = "Uploads/Gallery/";

        $original_name =
            $_FILES['gallery_image']['name'];

        $tmp_name =
            $_FILES['gallery_image']['tmp_name'];

        $file_size =
            $_FILES['gallery_image']['size'];

        $extension = strtolower(
            pathinfo(
                $original_name,
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

        } elseif ($file_size > 5 * 1024 * 1024) {

            $error =
                "Image must be less than 5MB.";

        } else {

            // Delete old image
            if (
                !empty($image['image_name']) &&
                file_exists(
                    $upload_dir . $image['image_name']
                )
            ) {

                unlink(
                    $upload_dir . $image['image_name']
                );
            }


            // Generate new filename
            $image_name =
                time() .
                "_" .
                uniqid() .
                "." .
                $extension;


            if (!move_uploaded_file(
                $tmp_name,
                $upload_dir . $image_name
            )) {

                $error =
                    "Failed to upload the new image.";

            }

        }
    }


    // =============================
    // DATABASE UPDATE
    // =============================

    if (empty($error)) {

        $query = "

            UPDATE gallery SET

                image_name = '$image_name',

                title = '$title',

                description = '$description',

                status = '$status'

            WHERE gallery_id = $gallery_id

        ";


        if (mysqli_query($conn, $query)) {

            header(
                "Location: gallery.php?updated=1"
            );

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

    <title>Edit Gallery Image</title>

    <link
        rel="stylesheet"
        href="./css/admin.css"
    >

    <style>

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 11px 13px;
            border: 1px solid #ddd;
            border-radius: 7px;
            font-family: Poppins, sans-serif;
            font-size: 12px;
            outline: none;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #dc2626;
        }

        .form-group textarea {
            resize: vertical;
        }

        .current-image {
            width: 250px;
            height: 170px;
            object-fit: cover;
            border-radius: 10px;
            display: block;
            margin-bottom: 12px;
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 20px;
            font-size: 12px;
        }

    </style>

</head>


<body>

<?php include "header.php"; ?>


<main class="main">

    <div class="content">


        <div class="page-title">

            <h1>Edit Gallery Image</h1>

            <p>
                Update your gallery photo.
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


                    <!-- CURRENT IMAGE -->

                    <div class="form-group">

                        <label>Current Image</label>

                        <?php if (!empty($image['image_name'])): ?>

                            <img
                                src="Uploads/Gallery/<?= htmlspecialchars(
                                    $image['image_name']
                                ); ?>"
                                class="current-image"
                                alt="Current gallery image"
                            >

                        <?php endif; ?>


                        <label>Replace Image</label>

                        <input
                            type="file"
                            name="gallery_image"
                            accept="image/jpeg,image/png,image/webp"
                        >

                        <small style="color:#888;">
                            Leave empty to keep the current image.
                        </small>

                    </div>


                    <!-- TITLE -->

                    <div class="form-group">

                        <label>Title</label>

                        <input
                            type="text"
                            name="title"
                            value="<?= htmlspecialchars(
                                $image['title'] ?? ''
                            ); ?>"
                            placeholder="e.g. Sunday Mountain Ride"
                        >

                    </div>


                    <!-- DESCRIPTION -->

                    <div class="form-group">

                        <label>Description</label>

                        <textarea
                            name="description"
                            rows="5"
                        ><?= htmlspecialchars(
                            $image['description'] ?? ''
                        ); ?></textarea>

                    </div>


                    <!-- STATUS -->

                    <div class="form-group">

                        <label>Status</label>

                        <select name="status">

                            <option
                                value="active"
                                <?= $image['status'] == 'active'
                                    ? 'selected'
                                    : ''; ?>
                            >
                                Active
                            </option>

                            <option
                                value="hidden"
                                <?= $image['status'] == 'hidden'
                                    ? 'selected'
                                    : ''; ?>
                            >
                                Hidden
                            </option>

                        </select>

                    </div>


                    <button
                        type="submit"
                        name="update_gallery"
                        class="btn btn-red"
                    >
                        Update Image
                    </button>


                    <a
                        href="gallery.php"
                        class="btn btn-light"
                    >
                        Cancel
                    </a>


                </form>


            </div>

        </div>


    </div>

</main>

</body>

</html>