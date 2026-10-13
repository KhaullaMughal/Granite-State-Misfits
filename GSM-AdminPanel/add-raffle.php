<?php
include "connection.php";

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $prize = mysqli_real_escape_string($conn, $_POST['prize']);
    $draw_date = mysqli_real_escape_string($conn, $_POST['draw_date']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $image = "";


    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

        $upload_dir = "Uploads/";

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $image_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];

        $extension = strtolower(
            pathinfo($image_name, PATHINFO_EXTENSION)
        );

        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($extension, $allowed)) {

            $image = time() . "_" . basename($image_name);

            move_uploaded_file(
                $tmp_name,
                $upload_dir . $image
            );

        } else {

            $message = "Only JPG, JPEG, PNG and WEBP images are allowed.";
            $message_type = "error";
        }
    }

    if ($message == "") {

        $query = "INSERT INTO raffles
                  (title, description, prize, image, draw_date, status)
                  VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param(
            $stmt,
            "ssssss",
            $title,
            $description,
            $prize,
            $image,
            $draw_date,
            $status
        );

        if (mysqli_stmt_execute($stmt)) {

            header("Location: raffle.php?success=1");
            exit;

        } else {

            $message = "Failed to add raffle.";
            $message_type = "error";
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Raffle | Granite State Misfits</title>

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

        .form-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 25px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
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

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 7px;
            padding: 11px 12px;
            font-family: inherit;
            font-size: 12px;
            outline: none;
            background: #fff;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #dc2626;
        }

        .form-group textarea {
            min-height: 130px;
            resize: vertical;
        }

        .form-group input[type="file"] {
            padding: 9px;
        }

        .form-actions {
            display: flex;
            gap: 8px;
            margin-top: 10px;
        }

        .btn {
            border: none;
            padding: 9px 15px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-add {
            background: #dc2626;
            color: white;
        }

        .btn-add:hover {
            background: #b91c1c;
            color: white;
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
            padding: 12px 15px;
            border-radius: 7px;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .alert-error {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .required {
            color: #dc2626;
        }

        @media (max-width: 700px) {

            .page-container {
                padding: 20px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
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

                <h1>Add Raffle</h1>

                <p>
                    Create a new raffle for your community.
                </p>

            </div>

            <a href="raffle.php" class="btn btn-cancel">
                ← Back to Raffles
            </a>

        </div>


        <!-- ERROR MESSAGE -->

        <?php if ($message != ""): ?>

            <div class="alert alert-error">
                <?= htmlspecialchars($message); ?>
            </div>

        <?php endif; ?>


        <!-- FORM CARD -->

        <div class="form-card">

            <form
                method="POST"
                action=""
                enctype="multipart/form-data"
            >

                <div class="form-row">


                    <!-- TITLE -->

                    <div class="form-group">

                        <label>
                            Raffle Title <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            placeholder="Enter raffle title"
                            required
                        >

                    </div>


                    <!-- PRIZE -->

                    <div class="form-group">

                        <label>
                            Prize <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="prize"
                            placeholder="Enter raffle prize"
                            required
                        >

                    </div>


                    <!-- DRAW DATE -->

                    <div class="form-group">

                        <label>
                            Draw Date <span class="required">*</span>
                        </label>

                        <input
                            type="date"
                            name="draw_date"
                            required
                        >

                    </div>


                    <!-- STATUS -->

                    <div class="form-group">

                        <label>
                            Status
                        </label>

                        <select name="status">

                            <option value="active">
                                Active
                            </option>

                            <option value="closed">
                                Closed
                            </option>

                            <option value="completed">
                                Completed
                            </option>

                        </select>

                    </div>


                    <!-- IMAGE -->

                    <div class="form-group full">

                        <label>
                            Raffle Image
                        </label>

                        <input
                            type="file"
                            name="image"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                    </div>


                    <!-- DESCRIPTION -->

                    <div class="form-group full">

                        <label>
                            Description <span class="required">*</span>
                        </label>

                        <textarea
                            name="description"
                            placeholder="Enter raffle description..."
                            required
                        ></textarea>

                    </div>

                </div>


                <!-- BUTTONS -->

                <div class="form-actions">

                    <button
                        type="submit"
                        class="btn btn-add"
                    >
                        + Add Raffle
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