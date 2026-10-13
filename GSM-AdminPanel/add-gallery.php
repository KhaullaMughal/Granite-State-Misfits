<?php

include "connection.php";

$error = "";

if (isset($_POST['add_gallery'])) {

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


    if (
        !isset($_FILES['gallery_image']) ||
        $_FILES['gallery_image']['error'] != 0
    ) {

        $error = "Please select an image.";

    } else {


        $upload_dir = "Uploads/Gallery/";


        if (!is_dir($upload_dir)) {

            mkdir(
                $upload_dir,
                0777,
                true
            );

        }


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


            $image_name =
                time() .
                "_" .
                uniqid() .
                "." .
                $extension;


            if (
                move_uploaded_file(
                    $tmp_name,
                    $upload_dir . $image_name
                )
            ) {


                $query = "

                    INSERT INTO gallery
                    (
                        image_name,
                        title,
                        description,
                        status
                    )

                    VALUES
                    (
                        '$image_name',
                        '$title',
                        '$description',
                        '$status'
                    )

                ";


                if (mysqli_query($conn, $query)) {

                    header(
                        "Location: gallery.php?added=1"
                    );

                    exit;

                } else {

                    $error =
                        "Database error: " .
                        mysqli_error($conn);

                }

            } else {

                $error =
                    "Failed to upload image.";

            }

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

    <title>Add Gallery Image</title>

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
        }

        .form-group textarea {
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

    </style>

</head>


<body>

<?php include "header.php"; ?>


<main class="main">

    <div class="content">


        <div class="page-title">

            <h1>Add Gallery Image</h1>

            <p>
                Upload a new photo to your gallery.
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


                    <div class="form-group">

                        <label>Gallery Image *</label>

                        <input
                            type="file"
                            name="gallery_image"
                            accept="image/jpeg,image/png,image/webp"
                            required
                        >

                        <small style="color:#888;">
                            JPG, PNG or WEBP — maximum 5MB.
                        </small>

                    </div>


                    <div class="form-group">

                        <label>Title</label>

                        <input
                            type="text"
                            name="title"
                            placeholder="e.g. White Mountains Ride"
                        >

                    </div>


                    <div class="form-group">

                        <label>Description</label>

                        <textarea
                            name="description"
                            rows="4"
                            placeholder="Describe this photo..."
                        ></textarea>

                    </div>


                    <div class="form-group">

                        <label>Status</label>

                        <select name="status">

                            <option value="active">
                                Active
                            </option>

                            <option value="hidden">
                                Hidden
                            </option>

                        </select>

                    </div>


                    <button
                        type="submit"
                        name="add_gallery"
                        class="btn btn-red"
                    >
                        Upload Image
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