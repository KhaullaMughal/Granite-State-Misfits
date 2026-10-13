<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="./css/header.css">
</head>
<body>
   <!-- Sidebar -->
<aside class="sidebar" id="sidebar">
 <!-- Close Sidebar Button -->
    <button class="sidebar-close" onclick="toggleSidebar()" aria-label="Close sidebar">
        &times;
    </button>
    <div class="logo">
        <h2>GRANITE <span>STATE</span></h2>
    </div>

    <div class="admin-label">
        Administration
    </div>

    <nav class="menu">

        <a href="dashboard.php">
            <span class="menu-icon">▦</span>
            <span>Dashboard</span>
        </a>

        <a href="rides.php">
            <span class="menu-icon">🏍</span>
            <span>Rides</span>
        </a>

        <a href="raffle.php">
            <span class="menu-icon">🎟</span>
            <span>Raffle Tickets</span>
        </a>


        <a href="gallery.php">
            <span class="menu-icon">📸</span>
            <span>Gallery</span>
        </a>

        <a href="contact-messages.php">
    <span class="menu-icon">✉️</span>
    <span>Contact Messages</span>
</a>


    </nav>


    <div class="logout">

        <a href="/GSM-AdminPanel/" class="logout-btn">
    <i class="fa-solid fa-right-from-bracket"></i>
    Logout
</a>
        

    </div>

</aside>

<!-- topbar -->
    <header class="topbar">

<button class="menu-toggle" onclick="toggleSidebar()" aria-label="Toggle Menu">
    ☰
</button>
        <div class="top-title">
            <h3>Admin Dashboard</h3>
            <p>Manage your ride website</p>
        </div>
        <div class="admin-profile">
            <div class="admin-avatar">A</div>
            <div>
                <strong>Administrator</strong>
                <small>Admin</small>
            </div>

        </div>

    </header>

    <script>
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');

    if (sidebar) {
        sidebar.classList.toggle('show');
    }
}</script>
</body>
</html>