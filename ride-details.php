<?php
include '../Rideweb/GSM-AdminPanel/connection.php';

if (isset($_GET['id'])) {

    $ride_id = intval($_GET['id']);

    $query = "SELECT * FROM rides WHERE ride_id = $ride_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $ride = mysqli_fetch_assoc($result);
    } else {
        echo "Ride not found.";
        exit;
    }

} else {
    echo "No ride selected.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <title>RIDES | GRANITE STATE MISFITS</title>
  <link rel="stylesheet" href="ride-details.css">
  <link rel="icon" href="./images/logo.jpeg">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">

</head>
<body>
   <!-- Navigation bar -->
<?php include 'GSMheader.php'; ?>
<!-- Hero Section -->
<section class="rides">
   <div class="overlay">
  <div class="container">
    <div class="row">
      <div class="col-12 rides-content"  data-aos="fade-up"
     data-aos-duration="3000">
        <h1>Ride<span> Details</span></h1>
       <p>Get all the information about this ride before hitting the road.</p>
      </div>
    </div>
  </div>
   </div>
</section>

<!-- Rides details Section -->
<!-- ================= RIDE DETAILS SECTION ================= -->
<section class="ride-details-section">

  <div class="container">


    <div class="ride-details-card" data-aos="fade-up">

      <!-- Ride Image -->
      <div class="ride-image">
      
       <img src="./GSM-AdminPanel/Uploads/<?php echo htmlspecialchars($ride['ride_image']); ?>" 
     alt="<?php echo htmlspecialchars($ride['ride_name']); ?>">

        <div class="ride-status">
          <i class="fa-solid fa-circle"></i> <?php echo $ride['status']; ?>
        </div>
      </div>

      <!-- Ride Information -->
      <div class="ride-content">

        <div class="ride-title-row">
          <div>
            <span class="ride-label">RIDE #<?php echo $ride_id;  ?> </span>
            <h3><?php echo $ride['ride_name'];  ?></h3>
          </div>

          <div class="ride-type">
            <i class="fa-solid fa-motorcycle"></i>
            Group Ride
          </div>
        </div>

        <p class="ride-description">
          Join the Granite State Misfits for an exciting ride through the
          beautiful roads. This ride is open to everyone
          who loves motorcycles, good roads, and great company.
        </p>

        <!-- Ride Information Grid -->
        <div class="ride-info-grid">

          <!-- Date -->
          <div class="ride-info-item">
            <div class="ride-info-icon">
              <i class="fa-regular fa-calendar"></i>
            </div>
            <div>
              <span>Date</span>
              <strong><?php echo $ride['ride_date']; ?></strong>
            </div>
          </div>

          <!-- Start Time -->
          <div class="ride-info-item">
            <div class="ride-info-icon">
              <i class="fa-regular fa-clock"></i>
            </div>
            <div>
              <span>Start Time</span>
              <strong><?php echo $ride['departure_time']; ?></strong>
            </div>
          </div>

          <!-- Start Location -->
          <div class="ride-info-item">
            <div class="ride-info-icon">
              <i class="fa-solid fa-location-dot"></i>
            </div>
            <div>
              <span>Starting Location</span>
              <strong><?php echo $ride['start_location']; ?></strong>
            </div>
          </div>

          <!-- Destination -->
          <div class="ride-info-item">
            <div class="ride-info-icon">
              <i class="fa-solid fa-flag-checkered"></i>
            </div>
            <div>
              <span>Destination</span>
              <strong><?php echo $ride['destination']; ?></strong>
            </div>
          </div>

          <!-- Distance -->
          <div class="ride-info-item">
            <div class="ride-info-icon">
              <i class="fa-solid fa-road"></i>
            </div>
            <div>
              <span>Distance</span>
              <strong><?php echo $ride['distance']; ?></strong>
            </div>
          </div>

          <!-- Duration -->
          <div class="ride-info-item">
            <div class="ride-info-icon">
              <i class="fa-solid fa-stopwatch"></i>
            </div>
            <div>
              <span>Estimated Duration</span>
              <strong><?php echo $ride['estimated_duration']; ?></strong>
            </div>
          </div>

          <!-- Meeting Point -->
          <div class="ride-info-item">
            <div class="ride-info-icon">
              <i class="fa-solid fa-map-pin"></i>
            </div>
            <div>
              <span>Meeting Point</span>
              <strong>Manchester Bike Shop</strong>
            </div>
          </div>

          <!-- Ride Leader -->
          <div class="ride-info-item">
            <div class="ride-info-icon">
              <i class="fa-solid fa-user"></i>
            </div>
            <div>
              <span>Difficulty Level</span>
              <strong><?php echo $ride['difficulty_level']; ?></strong>
            </div>
          </div>

        </div>

        <!-- Ride Description -->
        <div class="ride-extra-info">

          <h4>About This Ride</h4>

          <p>
            <?php echo $ride['description']; ?>
          </p>

          <p>
            Riders should arrive at least 15 minutes before departure.
            Make sure your motorcycle is fueled and ready for the ride.
          </p>

        </div>

        <!-- Ride Requirements -->
        <div class="ride-requirements">

          <h4>Ride Requirements</h4>

          <div class="requirement-list">

            <div>
              <i class="fa-solid fa-check"></i>
              Valid motorcycle license
            </div>

            <div>
              <i class="fa-solid fa-check"></i>
              Proper riding gear
            </div>

            <div>
              <i class="fa-solid fa-check"></i>
              Full tank of fuel
            </div>

            <div>
              <i class="fa-solid fa-check"></i>
              Helmet required
            </div>

          </div>

        </div>

        <!-- Action Buttons -->
        <div class="ride-actions">

          <a href="./contact.php" class="ride-join-btn">
            JOIN THIS RIDE
            <i class="fa-solid fa-arrow-right"></i>
          </a>

          <a href="./Rides.php" class="ride-back-btn">
            <i class="fa-solid fa-arrow-left"></i>
            BACK TO RIDES
          </a>

        </div>

      </div>

    </div>

  </div>

</section>
<!-- ================= END RIDE DETAILS SECTION ================= -->
 

<footer>
  <div class="footer-container">

    <div class="footer-logo">
        <img src="./images/logo.jpeg" alt="Granite State Misfits NH" class="logo-img">
      <p class="tagline">
        No club. No rules. Just misfits<br>
        who ride for the love of it.<br>
        Ride hard. Respect all.
      </p>

      <div class="social-icons">
        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
      </div>
    </div>

    <div class="footer-col">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Rides</a></li>
        <li><a href="#">Raffle</a></li>
        <li><a href="#">Gallery</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h3>Join The Group</h3>
      <p class="join-text">
        The social group is the way to join. Click below to become part of the crew.
      </p>
      <a href="#" class="join-btn">
        JOIN THE GROUP <i class="fab fa-facebook-f"></i>
      </a>
    </div>

    <div class="footer-col">
      <h3>Contact</h3>
      <div class="contact-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#c41e3a" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin-icon lucide-map-pin"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
        <span>New Hampshire, USA</span>
      </div>
      <div class="contact-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#c41e3a" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail"><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>
        <a href="mailto:granitestatemisfitsnh@gmail.com">granitestatemisfitsnh@gmail.com</a>
      </div>
      <div class="contact-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#c41e3a" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>
        <a href="#">Follow us on Facebook</a>
      </div>
    </div>

    <div class="footer-col">
      <h3>Disclaimer</h3>
      <p class="disclaimer-text">
        By accessing this website and/or joining the group and/or attending group events and/or interacting with content on this website, you agree to release, waive, discharge, and covenant not to sue the site owners, organizers, hosts, affiliates, and any other users from any and all liability.
      </p>
      <a href="#" class="disclaimer-link">Disclaimer / Waiver</a>
    </div>

  </div>

  <div class="footer-bottom">
    <div class="copyright">© 2025 Granite State Misfits. All rights reserved.</div>
    <a href="#" class="disclaimer-link">Disclaimer / Waiver</a>
  </div>
</footer>
<!-- Bootstrap CDN for JS -->
  <script src="./script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

  <!-- Lucide icons link-->
   <script src="https://unpkg.com/lucide@latest"></script>
   <script>
    lucide.createIcons();
</script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>