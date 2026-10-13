<?php

include "connection.php";

$query = "SELECT * FROM gallery ORDER BY created_at DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Database error: " . mysqli_error($conn));
}
$message = "";

if (isset($_GET['added'])) {
    $message = "Gallery image uploaded successfully.";
}

if (isset($_GET['updated'])) {
    $message = "Gallery image updated successfully.";
}

if (isset($_GET['deleted'])) {
    $message = "Gallery image deleted successfully.";
}
?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Manage Gallery | Granite State Misfits</title>

    <link rel="stylesheet" href="./css/admin.css">

    <style>

        .gallery-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .gallery-header h1 {
            font-size: 27px;
            margin-bottom: 5px;
        }

        .gallery-header p {
            color: #777;
            font-size: 13px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns:
                repeat(3, 1fr);
            gap: 20px;
        }

        .gallery-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 12px;
            overflow: hidden;
        }

        .gallery-card-image {
            width: 100%;
            height: 210px;
            object-fit: cover;
            display: block;
        }

        .gallery-card-body {
            padding: 15px;
        }

        .gallery-card-body h3 {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .gallery-card-body p {
            font-size: 11px;
            color: #888;
            margin-bottom: 12px;
        }

        .gallery-actions {
            display: flex;
            gap: 6px;
        }

        .gallery-actions a {
            text-decoration: none;
        }

        .empty-gallery {
            text-align: center;
            padding: 60px 20px;
            background: #fff;
            border-radius: 12px;
        }

        @media(max-width:1000px) {

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media(max-width:600px) {

            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .gallery-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

        }

    </style>

</head>


<body>
<div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    <?php include "header.php"; ?>



<main class="main">

    <div class="content">


        <div class="gallery-header">

            <div>

                <h1>Gallery</h1>

                <p>
                    Manage photos from rides and events.
                </p>

            </div>


            <a href="add-gallery.php"
               class="btn btn-red">

                + Add Image

            </a>

        </div>


        <?php if (mysqli_num_rows($result) > 0): ?>

          <?php if ($message): ?>

    <div
        style="
            background:#dcfce7;
            color:#15803d;
            padding:13px 16px;
            border-radius:8px;
            margin-bottom:20px;
            font-size:12px;
        "
    >

        <?= htmlspecialchars($message); ?>

    </div>

<?php endif; ?>

            <div class="gallery-grid">


                <?php while ($image = mysqli_fetch_assoc($result)): ?>


                    <div class="gallery-card">


                        <img
                            src="Uploads/Gallery/<?= htmlspecialchars(
                                $image['image_name']
                            ); ?>"
                            class="gallery-card-image"
                            alt="<?= htmlspecialchars(
                                $image['title'] ?? 'Gallery image'
                            ); ?>"
                        >


                        <div class="gallery-card-body">


                            <h3>

                                <?= htmlspecialchars(
                                    $image['title'] ?? 'Untitled'
                                ); ?>

                            </h3>


                            <p>

                                <?= htmlspecialchars(
                                    $image['description'] ?? ''
                                ); ?>

                            </p>


                            <div class="gallery-actions">


                                <a
                                    href="view-gallery.php?id=<?= $image['gallery_id']; ?>"
                                    class="btn btn-light"
                                >
                                    View
                                </a>


                                <a
                                    href="edit-gallery.php?id=<?= $image['gallery_id']; ?>"
                                    class="btn btn-light"
                                >
                                    Edit
                                </a>


                                <a
                                    href="delete-gallery.php?id=<?= $image['gallery_id']; ?>"
                                    class="btn btn-danger"
                                    onclick="return confirm(
                                        'Delete this gallery image?'
                                    );"
                                >
                                    Delete
                                </a>


                            </div>


                        </div>


                    </div>


                <?php endwhile; ?>


            </div>


        <?php else: ?>


            <div class="empty-gallery">

                <h3>No Gallery Images</h3>

                <p>
                    Upload your first ride or event photo.
                </p>

                <a
                    href="add-gallery.php"
                    class="btn btn-red"
                >
                    + Add Image
                </a>

            </div>


        <?php endif; ?>


    </div>

</main>

</body>

</html>