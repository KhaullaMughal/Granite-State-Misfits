<?php

include "connection.php";


if (!isset($_GET['id'])) {

    header("Location: gallery.php");

    exit;
}


$gallery_id = intval($_GET['id']);


$query = "
    SELECT *
    FROM gallery
    WHERE gallery_id = $gallery_id
";


$result = mysqli_query($conn, $query);


if (!$result || mysqli_num_rows($result) == 0) {

    die("Gallery image not found.");

}


$image = mysqli_fetch_assoc($result);

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
        <?= htmlspecialchars(
            $image['title'] ?? 'Gallery Image'
        ); ?>
    </title>

    <link
        rel="stylesheet"
        href="./css/admin.css"
    >

    <style>

        .gallery-view {
            max-width: 850px;
            margin: auto;
        }

        .gallery-view-image {
            width: 100%;
            max-height: 600px;
            object-fit: cover;
            border-radius: 12px;
            display: block;
            margin-bottom: 25px;
        }

        .gallery-info {
            padding: 20px;
            background: #fafafa;
            border-radius: 10px;
            border: 1px solid #eee;
        }

        .gallery-info h2 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .gallery-info p {
            font-size: 13px;
            color: #666;
            line-height: 1.7;
        }

        .gallery-meta {
            display: flex;
            gap: 25px;
            margin-top: 15px;
            font-size: 11px;
            color: #777;
        }

    </style>

</head>


<body>

<?php include "header.php"; ?>


<main class="main">

    <div class="content">


        <div class="page-title">

            <h1>Gallery Preview</h1>

            <p>
                View gallery image details.
            </p>

        </div>


        <div class="card">

            <div class="card-body">


                <div class="gallery-view">


                    <?php if (!empty($image['image_name'])): ?>

                        <img
                            src="Uploads/Gallery/<?= htmlspecialchars(
                                $image['image_name']
                            ); ?>"
                            class="gallery-view-image"
                            alt="<?= htmlspecialchars(
                                $image['title'] ?? 'Gallery image'
                            ); ?>"
                        >

                    <?php endif; ?>


                    <div class="gallery-info">


                        <h2>

                            <?= htmlspecialchars(
                                $image['title'] ?? 'Untitled'
                            ); ?>

                        </h2>


                        <?php if (!empty($image['description'])): ?>

                            <p>

                                <?= nl2br(
                                    htmlspecialchars(
                                        $image['description']
                                    )
                                ); ?>

                            </p>

                        <?php else: ?>

                            <p>
                                No description available.
                            </p>

                        <?php endif; ?>


                        <div class="gallery-meta">

                            <span>
                                ID:
                                #<?= $image['gallery_id']; ?>
                            </span>

                            <span>
                                Status:
                                <?= htmlspecialchars(
                                    $image['status']
                                ); ?>
                            </span>

                            <span>
                                Uploaded:
                                <?= date(
                                    "M d, Y",
                                    strtotime(
                                        $image['created_at']
                                    )
                                ); ?>
                            </span>

                        </div>


                    </div>


                    <div style="margin-top:20px;">


                        <a
                            href="edit-gallery.php?id=<?= $image['gallery_id']; ?>"
                            class="btn btn-red"
                        >
                            Edit Image
                        </a>


                        <a
                            href="delete-gallery.php?id=<?= $image['gallery_id']; ?>"
                            class="btn btn-danger"
                            onclick="return confirm(
                                'Are you sure you want to delete this image?'
                            );"
                        >
                            Delete
                        </a>


                        <a
                            href="gallery.php"
                            class="btn btn-light"
                        >
                            Back to Gallery
                        </a>


                    </div>


                </div>


            </div>

        </div>


    </div>

</main>

</body>

</html>