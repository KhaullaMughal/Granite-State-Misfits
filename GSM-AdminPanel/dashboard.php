<?php
session_start();

include "connection.php";

if (!isset($_SESSION['Admin_email'])) {
    header("Location: login.php");
    exit;
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

if (!isset($_SESSION['Admin_email'])) {
    header("Location: login.php");
    exit;
}
$query = "SELECT * FROM rides ORDER BY ride_date ASC LIMIT 5";
$result = mysqli_query($conn, $query);

$total_rides_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM rides"
);

$total_rides = mysqli_fetch_assoc(
    $total_rides_query
)['total'];

$upcoming_rides_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM rides
     WHERE ride_date >= CURDATE()
     AND status != 'completed'"
);

$upcoming_rides = mysqli_fetch_assoc(
    $upcoming_rides_query
)['total'];


$completed_rides_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM rides
     WHERE status = 'completed'
     OR ride_date < CURDATE()"
);

$completed_rides = mysqli_fetch_assoc(
    $completed_rides_query
)['total'];


$messages_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM contact_messages
     WHERE status = 'Unread'"
);

$unread_messages = mysqli_fetch_assoc(
    $messages_query
)['total'];

$gallery_query = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM gallery
     WHERE status = 'active'"
);

$gallery_images = mysqli_fetch_assoc(
    $gallery_query
)['total'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard | Granite State Misfits</title>
    <link rel="stylesheet" href="./css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;600;700;800&display=swap" rel="stylesheet">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f5f5;
            color: #222;
        }

/* =========================================
   RESPONSIVE DASHBOARD
========================================= */

/* TABLET */
@media screen and (max-width: 1100px) {

    .main {
        margin-left: 0 !important;
        width: 100% !important;
    }

    .sidebar {
        left: -250px !important;
        transition: left 0.3s ease;
    }

    .sidebar.show {
        left: 0 !important;
    }

    .menu-toggle {
        display: flex !important;
        align-items: center;
        justify-content: center;
    }

    .stats {
        grid-template-columns: repeat(2, 1fr) !important;
    }

    .dashboard-grid {
        grid-template-columns: 1fr !important;
    }

}


/* MOBILE */
@media screen and (max-width: 600px) {

    .content {
        padding: 15px !important;
    }

    .topbar {
        height: 65px !important;
        padding: 0 15px !important;
    }

    .menu-toggle {
        display: flex !important;
        width: 40px;
        height: 40px;
        font-size: 22px;
    }

    .top-title {
        display: none !important;
    }

    .admin-profile div {
        display: none !important;
    }

    .stats {
        display: grid !important;
        grid-template-columns: 1fr !important;
        gap: 12px !important;
    }

    .stat-card {
        width: 100% !important;
        padding: 16px !important;
    }

    .dashboard-grid {
        display: grid !important;
        grid-template-columns: 1fr !important;
        gap: 15px !important;
    }

    .card {
        width: 100% !important;
    }

    .card-header {
        padding: 15px !important;
    }

    .card-header h2 {
        font-size: 15px !important;
    }

    .table-wrapper {
        width: 100% !important;
        overflow-x: auto !important;
    }

    table {
        min-width: 650px !important;
    }

}


/* SMALL MOBILE */
@media screen and (max-width: 400px) {

    .content {
        padding: 10px !important;
    }

    .stat-card {
        padding: 13px !important;
    }

    .stat-icon {
        width: 40px !important;
        height: 40px !important;
    }

    .page-title h1 {
        font-size: 21px !important;
    }

    .page-title p {
        font-size: 10px !important;
    }

}


        button,
        input,
        select {
            font-family: inherit;
        }

        a {
            text-decoration: none;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #080808;
            color: white;
            z-index: 1000;
            transition: .3s;
        }

        .logo {
            height: 75px;
            display: flex;
            align-items: center;
            padding: 0 25px;
            border-bottom: 1px solid #222;
        }

        .logo h2 {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: .5px;
        }

        .logo span {
            color: #dc2626;
        }

        .admin-label {
            padding: 25px 25px 10px;
            color: #777;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .menu {
            padding: 0 12px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 14px;
            color: #aaa;
            padding: 13px 14px;
            border-radius: 7px;
            margin-bottom: 5px;
            font-size: 13px;
            transition: .3s;
        }

        .menu a:hover,
        .menu a.active {
            background: #dc2626;
            color: white;
        }

        .menu-icon {
            width: 22px;
            text-align: center;
            font-size: 17px;
        }

        .logout {
            position: absolute;
            bottom: 20px;
            left: 12px;
            right: 12px;
        }

        .logout a {
            color: #aaa;
            display: flex;
            gap: 14px;
            padding: 13px 14px;
            font-size: 13px;
            border-radius: 7px;
        }

        .logout a:hover {
            background: #222;
            color: white;
        }


        /* =========================
           MAIN
        ========================= */

        .main {
            margin-left: 250px;
            min-height: 100vh;
        }


        /* =========================
           TOPBAR
        ========================= */

        .topbar {
            height: 75px;
            background: white;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .menu-toggle {
            display: none;
            border: none;
            background: none;
            font-size: 25px;
            cursor: pointer;
        }

        .top-title h3 {
            font-size: 18px;
        }

        .top-title p {
            font-size: 11px;
            color: #888;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #dc2626;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .admin-profile strong {
            font-size: 13px;
        }

        .admin-profile small {
            display: block;
            color: #888;
            font-size: 10px;
        }


        /* =========================
           CONTENT
        ========================= */

        .content {
            padding: 30px;
        }

        .page-title {
            margin-bottom: 25px;
        }

        .page-title h1 {
            font-size: 27px;
            margin-bottom: 5px;
        }

        .page-title p {
            font-size: 13px;
            color: #777;
        }


        /* =========================
           STAT CARDS
        ========================= */

        .stats {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 22px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: .3s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,.06);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: #fee2e2;
            color: #dc2626;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .stat-card h2 {
            font-size: 24px;
            line-height: 1;
            margin-bottom: 5px;
        }

        .stat-card p {
            font-size: 11px;
            color: #888;
        }


        /* =========================
           MAIN GRID
        ========================= */

        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
        }

        .card {
            background: white;
            border: 1px solid #eee;
            border-radius: 12px;
            overflow: hidden;
        }

        .card-header {
            padding: 20px 22px;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header h2 {
            font-size: 17px;
        }

        .card-body {
            padding: 20px;
        }


        /* =========================
           BUTTONS
        ========================= */

        .btn {
            border: none;
            padding: 9px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 11px;
            font-weight: 600;
        }

        .btn-red {
            background: #dc2626;
            color: white;
        }

        .btn-red:hover {
            background: #b91c1c;
        }

        .btn-light {
            background: #f1f1f1;
            color: #333;
        }

        .btn-danger {
            background: #fee2e2;
            color: #dc2626;
        }


        /* =========================
           RIDES TABLE
        ========================= */

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th {
            background: #fafafa;
            color: #777;
            font-size: 10px;
            text-align: left;
            padding: 13px;
            text-transform: uppercase;
        }

        td {
            padding: 14px 13px;
            border-top: 1px solid #eee;
            font-size: 12px;
        }

        .ride-name {
            font-weight: 600;
        }

        .status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 600;
        }

        .status.open {
            background: #dcfce7;
            color: #15803d;
        }

        .status.closed {
            background: #fee2e2;
            color: #dc2626;
        }

        .actions {
            display: flex;
            gap: 5px;
        }


        /* =========================
           QUICK ACTIONS
        ========================= */

        .quick-action {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px;
            border: 1px solid #eee;
            border-radius: 8px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: .3s;
        }

        .quick-action:hover {
            border-color: #dc2626;
            background: #fffafa;
        }

        .quick-icon {
            width: 40px;
            height: 40px;
            border-radius: 7px;
            background: #111;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quick-action:hover .quick-icon {
            background: #dc2626;
        }

        .quick-action h4 {
            font-size: 12px;
        }

        .quick-action p {
            font-size: 10px;
            color: #888;
            margin-top: 2px;
        }


        /* =========================
           RECENT BOOKINGS
        ========================= */

        .booking {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .booking:last-child {
            border-bottom: none;
        }

        .booking-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 12px;
        }

        .booking-info {
            flex: 1;
        }

        .booking-info strong {
            display: block;
            font-size: 11px;
        }

        .booking-info span {
            color: #888;
            font-size: 9px;
        }

        .booking-price {
            font-size: 11px;
            font-weight: 600;
        }

.sidebar-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
}

@media (max-width: 900px) {

    .sidebar.show ~ .sidebar-overlay {
        display: block;
    }

}
/* =========================
   RESPONSIVE
========================= */

/* Large Tablets / Small Laptops */
@media (max-width: 1200px) {

    .content {
        padding: 25px;
    }

    .stats {
        grid-template-columns: repeat(3, 1fr);
    }

    .dashboard-grid {
        grid-template-columns: 1fr;
    }

}


/* Tablets */
@media (max-width: 900px) {

    .sidebar {
        width: 250px;
        left: -250px;
        box-shadow: 5px 0 25px rgba(0,0,0,.2);
    }

    .sidebar.show {
        left: 0;
    }

    .main {
        margin-left: 0;
    }

    .menu-toggle {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 8px;
        background: #f5f5f5;
    }

    .menu-toggle:hover {
        background: #fee2e2;
        color: #dc2626;
    }

    .topbar {
        padding: 0 20px;
    }

    .content {
        padding: 22px;
    }

    .stats {
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .dashboard-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }

}


/* Mobile */
@media (max-width: 600px) {

    body {
        overflow-x: hidden;
    }

    .sidebar {
        width: 240px;
        left: -240px;
    }

    .sidebar.show {
        left: 0;
    }

    .main {
        width: 100%;
        margin-left: 0;
    }

    .topbar {
        height: 65px;
        padding: 0 15px;
    }

    .menu-toggle {
        width: 40px;
        height: 40px;
        font-size: 22px;
    }

    .top-title {
        display: none;
    }

    .admin-profile {
        gap: 8px;
    }

    .admin-profile div {
        display: none;
    }

    .admin-avatar {
        width: 36px;
        height: 36px;
        font-size: 12px;
    }

    .content {
        padding: 18px 14px;
    }

    .page-title {
        margin-bottom: 18px;
    }

    .page-title h1 {
        font-size: 23px;
    }

    .page-title p {
        font-size: 11px;
        line-height: 1.6;
    }


    /* STAT CARDS */

    .stats {
        grid-template-columns: 1fr;
        gap: 12px;
        margin-bottom: 20px;
    }

    .stat-card {
        padding: 17px;
        gap: 13px;
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        font-size: 18px;
        flex-shrink: 0;
    }

    .stat-card h2 {
        font-size: 21px;
    }

    .stat-card p {
        font-size: 10px;
    }


    /* CARDS */

    .card {
        border-radius: 10px;
    }

    .card-header {
        padding: 15px;
        gap: 10px;
    }

    .card-header h2 {
        font-size: 15px;
    }

    .card-body {
        padding: 15px;
    }


    /* ADD BUTTON */

    .card-header .btn {
        padding: 8px 10px;
        font-size: 10px;
        white-space: nowrap;
    }


    /* TABLE */

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    table {
        min-width: 650px;
    }

    th {
        padding: 11px;
        font-size: 9px;
    }

    td {
        padding: 12px 11px;
        font-size: 11px;
    }


    /* ACTION BUTTONS */

    .actions {
        flex-wrap: nowrap;
    }

    .actions .btn {
        padding: 7px 9px;
        font-size: 9px;
        white-space: nowrap;
    }


    /* QUICK ACTIONS */

    .quick-action {
        padding: 11px;
        gap: 10px;
    }

    .quick-icon {
        width: 37px;
        height: 37px;
        flex-shrink: 0;
        font-size: 15px;
    }

    .quick-action h4 {
        font-size: 11px;
    }

    .quick-action p {
        font-size: 9px;
    }

}


/* Very Small Phones */
@media (max-width: 400px) {

    .content {
        padding: 15px 10px;
    }

    .page-title h1 {
        font-size: 21px;
    }

    .page-title p {
        font-size: 10px;
    }

    .stat-card {
        padding: 14px;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
    }

    .stat-card h2 {
        font-size: 19px;
    }

    .card-header {
        padding: 13px;
    }

    .card-header h2 {
        font-size: 14px;
    }

    .card-body {
        padding: 13px;
    }

    .card-header .btn {
        padding: 7px 8px;
        font-size: 9px;
    }

}
    </style>
</head>


<body>

<div class="sidebar-overlay" onclick="toggleSidebar()"></div>
    <?php 
    include "header.php"; 
    ?>

<main class="main">

    <!-- CONTENT -->

    <div class="content">
        <div class="page-title">
            <h1>Dashboard</h1>
            <p>
                Welcome back! Here's what's happening with your ride website.
            </p>
        </div>

        <!-- STATISTICS -->

        <section class="stats">
            <div class="stat-card">
                <div class="stat-icon">
                    🏍
                </div>
                <div>
                    <h2> <?= $total_rides; ?></h2>
                    <p>Total Rides</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    📅
                </div>
                <div>
                    <h2>   <?= $upcoming_rides; ?></h2>
                    <p>Upcoming Rides</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    🎟
                </div>
                <div>
                    <h2><?= $completed_rides; ?></h2>
                    <p>Completed Rides</p>
                </div>
            </div>
            <div class="stat-card">

                <div class="stat-icon">
                    📋
                </div>

                <div>

                    <h2> <?= $gallery_images; ?></h2>
                    <p>Gallery Images</p>
                </div>
            </div>

            <div class="stat-card">
    <div class="stat-icon">
        ✉️
    </div>

    <div>
        <h2><?= $unread_messages; ?></h2>
        <p>Unread Messages</p>
    </div>
</div>
        </section>

        <!-- DASHBOARD GRID -->

        <section class="dashboard-grid">
            <!-- RIDES -->
            <div class="card">
                <div class="card-header">
                    <h2>Recent Rides</h2>
                    <button class="btn btn-red"
                            onclick="addRide()">
                        + Add Ride
                    </button>
                </div>


                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>Ride</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Actions</th>

                            </tr>

                        </thead>


                       <tbody>

<?php if (mysqli_num_rows($result) > 0): ?>

    <?php while ($ride = mysqli_fetch_assoc($result)): ?>

        <tr>

            <td class="ride-name">
                <?= htmlspecialchars($ride['ride_name']); ?>
            </td>

            <td>
                <?= date("M d, Y", strtotime($ride['ride_date'])); ?>
            </td>

            <td>
                <?= htmlspecialchars($ride['start_location']); ?>
            </td>

            <td>

                <?php if ($ride['status'] == 'upcoming'): ?>

                    <span class="status upcoming">
                        upcoming
                    </span>

                <?php else: ?>

                    <span class="status completed">
                        <?= htmlspecialchars($ride['status']); ?>
                    </span>

                <?php endif; ?>

            </td>

            <td>

                <div class="actions">

                    <!-- VIEW -->
                    <a href="view-ride.php?id=<?= $ride['ride_id']; ?>"
                       class="btn btn-light">
                        View
                    </a>

                    <!-- EDIT -->
                    <a href="edit-ride.php?id=<?= $ride['ride_id']; ?>"
                       class="btn btn-light">
                        Edit
                    </a>

                    <!-- DELETE -->
                    <a href="delete-ride.php?id=<?= $ride['ride_id']; ?>"
                       class="btn btn-danger"
                       onclick="return confirm('Are you sure you want to delete this ride?');">
                        Delete
                    </a>

                </div>

            </td>

        </tr>

    <?php endwhile; ?>

<?php else: ?>

    <tr>
        <td colspan="5" style="text-align:center;">
            No rides found.
        </td>
    </tr>

<?php endif; ?>

</tbody>

                    </table>

                </div>

            </div>



            <!-- RIGHT SIDE -->

            <div>


                <!-- QUICK ACTIONS -->

                <div class="card">

                    <div class="card-header">

                        <h2>Quick Actions</h2>

                    </div>


                    <div class="card-body">


                        <div class="quick-action"
                             onclick="addRide()">

                            <div class="quick-icon">
                                🏍
                            </div>

                            <div>

                                <h4>Add New Ride</h4>

                                <p>Create a new motorcycle ride</p>

                            </div>

                        </div>


                        <div class="quick-action"
                             onclick="manageRaffle()">

                            <div class="quick-icon">
                                🎟
                            </div>

                            <div>

                                <h4>Manage Raffle</h4>

                                <p>Manage tickets and winners</p>

                            </div>

                        </div>


                     

                        <div class="quick-action" onclick="managegallery()">

                            <div class="quick-icon">
                                📸
                            </div>

                            <div>

                                <h4>Manage Gallery</h4>

                                <p>Upload ride photos</p>

                            </div>

                        </div>


                    </div>

                </div>


                <br>


               
            </div>


        </section>

    </div>

</main>


<script src="js/admin.js"></script>
<script>


    // Add ride
    function addRide() {

        alert("Open Add Ride page/form.");
        window.location.href = "rides.php";

    }

    // Edit ride
    function editRide() {

        alert("Open Edit Ride page.");
        window.location.href = "edit-ride.php";

    }


    // Delete ride
    function deleteRide(button) {

        const confirmation =
            confirm("Are you sure you want to delete this ride?");

        if (confirmation) {

            button
                .closest("tr")
                .remove();

            alert("Ride deleted successfully.");

        }

    }


    // Manage raffle
    function manageRaffle() {

        alert("Opening Raffle Management...");
        window.location.href = "raffle.php"

    }
    function managegallery() {

         window.location.href = "gallery.php";

    }
    
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');

    if (sidebar) {
        sidebar.classList.toggle('show');
    }
}

</script>

</body>
</html>
