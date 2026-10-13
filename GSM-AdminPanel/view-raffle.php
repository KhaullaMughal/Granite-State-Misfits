<?php

include "connection.php";

if (!isset($_GET['id'])) {
    header("Location: raffle.php");
    exit;
}

$id = intval($_GET['id']);

$query = mysqli_query(
    $conn,
    "SELECT * FROM raffles WHERE raffle_id = $id"
);

$raffle = mysqli_fetch_assoc($query);

if (!$raffle) {
    die("Raffle not found.");
}


$entry_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM raffle_entries
     WHERE raffle_id = $id"
);

$entries = mysqli_fetch_assoc($entry_query)['total'];

?>

<!DOCTYPE html>
<html>

<head>

<title>View Raffle</title>

<link rel="stylesheet" href="./css/admin.css">

<style>

.view-container {
    padding: 30px;
}

.raffle-detail {
    background: white;
    border-radius: 12px;
    padding: 30px;
    max-width: 900px;
}

.raffle-detail img {
    width: 300px;
    height: 220px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 25px;
}

.detail-row {
    display: grid;
    grid-template-columns: 180px 1fr;
    padding: 14px 0;
    border-bottom: 1px solid #eee;
}

.detail-label {
    font-weight: 600;
    color: #777;
}

.btn {
    display: inline-block;
    padding: 10px 16px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
}

.btn-red {
    background: #dc2626;
    color: white;
}

.btn-light {
    background: #eee;
    color: #333;
}

</style>

</head>

<body>

<?php include "header.php"; ?>

<main class="main">

<div class="view-container">

<div class="raffle-detail">

<h1>
<?= htmlspecialchars($raffle['title']); ?>
</h1>

<br>

<?php if (!empty($raffle['image'])): ?>

<img
src="Uploads/<?= htmlspecialchars($raffle['image']); ?>"
alt="Raffle">

<?php endif; ?>


<div class="detail-row">

<div class="detail-label">
Prize
</div>

<div>
<?= htmlspecialchars($raffle['prize']); ?>
</div>

</div>


<div class="detail-row">

<div class="detail-label">
Description
</div>

<div>
<?= nl2br(
    htmlspecialchars($raffle['description'])
); ?>
</div>

</div>


<div class="detail-row">

<div class="detail-label">
Current Entries
</div>

<div>
<?= $entries; ?>
</div>

</div>


<div class="detail-row">

<div class="detail-label">
Status
</div>

<div>
<?= ucfirst(
    htmlspecialchars($raffle['status'])
); ?>
</div>

</div>


<br>

<a
href="edit-raffle.php?id=<?= $id; ?>"
class="btn btn-red">

Edit Raffle

</a>


<a
href="raffle-entries.php?id=<?= $id; ?>"
class="btn btn-light">

View Entries

</a>


<a
href="raffle.php"
class="btn btn-light">

Back

</a>

</div>

</div>

</main>

</body>

</html>