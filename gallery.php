<?php

include "GSM-AdminPanel/connection.php";

$query = "
    SELECT *
    FROM gallery
    WHERE status = 'active'
    ORDER BY created_at DESC
";

$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <title>ABOUT | GRANITE STATE MISFITS</title>
  <link rel="stylesheet" href="about.css">
  <link rel="icon" href="./images/logo.jpeg">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>
<body>
   <!-- Navigation bar -->
  <?php include 'GSMheader.php'; ?>


<section class="about-container">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
<div class="col-12 about-content" data-aos="fade-up"
     data-aos-duration="3000">
<h3>our <br><span>memories</span></h3>

 
      </div>
        </div>
    </div>
</section>





     

<!-- Gallery  -->
<section class="gallery py-5">
    <div class="container">

     <div class="row g-4">

    <?php if (mysqli_num_rows($result) > 0): ?>

        <?php while ($image = mysqli_fetch_assoc($result)): ?>

            <div class="col-lg-4 col-md-6 col-12">

                <div class="gallery-image">

                    <img
                        src="./GSM-AdminPanel/Uploads/Gallery/<?= htmlspecialchars(
                            $image['image_name']
                        ); ?>"
                        alt="<?= htmlspecialchars(
                            $image['title'] ?? 'Gallery image'
                        ); ?>"
                    >

                </div>

            </div>

        <?php endwhile; ?>

    <?php else: ?>

        <div class="col-12 text-center">

            <p>
                No gallery images available yet.
            </p>

        </div>

    <?php endif; ?>

</div>
        

    </div>
</section>



    <!-- Rides & Events Timeline -->
    <div class="events-history">
      <h3 class="events-title"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#c41e34" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bike-icon lucide-bike"><circle cx="18.5" cy="17.5" r="3.5"/><circle cx="5.5" cy="17.5" r="3.5"/><circle cx="15" cy="5" r="1"/><path d="M12 17.5V14l-3-3 4-3 2 3h2"/></svg> PAST RIDES & EVENTS</h3>
      
      <div class="events-list">
        <!-- Event Item -->
        <div class="event-item">
          <span class="event-date">Fri, Jul 31</span>
          <span class="event-name">Coastal Cruise</span>
        </div>
        
        <div class="event-item">
          <span class="event-date">Mon, Jul 27</span>
          <span class="event-name">PopUp T-shirts Night alongside Candia Towne Meet</span>
        </div>
        
        <div class="event-item">
          <span class="event-date">Sun, Jul 26</span>
          <span class="event-name">Sunday Sunapee Ride</span>
        </div>

        <div class="event-item">
          <span class="event-date">Sun, Jul 26</span>
          <span class="event-name">Mount Washington Redo x2</span>
        </div>

        <div class="event-item featured">
          <span class="event-date">Sun, Jul 19</span>
          <span class="event-name">🚨 MISFITS POP-UP RIDE 🚨 Mount Washington</span>
        </div>

        <div class="event-item">
          <span class="event-date">Sat, Jul 18</span>
          <span class="event-name">Collin Zaremba Memorial Ride</span>
        </div>

        <div class="event-item featured">
          <span class="event-date">Fri, Jul 17</span>
          <span class="event-name">🚨 MISFITS POP-UP RIDE 🚨</span>
        </div>

        <div class="event-item featured">
          <span class="event-date">Sun, Jul 12</span>
          <span class="event-name">🚨 KANGAMANGUS RIDE DAY</span>
        </div>

        <div class="event-item">
          <span class="event-date">Sun, Jul 12</span>
          <span class="event-name">Event 1 - PowerHouse Mall</span>
        </div>

        <div class="event-item">
          <span class="event-date">Sun, Jul 5</span>
          <span class="event-name">Just a cruise</span>
        </div>

        <div class="event-item">
          <span class="event-date">Sat, Jun 6</span>
          <span class="event-name">Beach Ride Hampton</span>
        </div>

        <div class="event-item">
          <span class="event-date">Sun, May 17</span>
          <span class="event-name">Boston’s Wounded Vet Ride 15</span>
        </div>
      </div>
    </div>

  </div>
</section>

 <!-- Join Us -->
<section class="join-us">
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="join-us-content">
                    <h1>
                        Ready to <br>
                        <span>Ride</span><br>
                        With Us?
                    </h1>

                    <p>
                        Good roads. Good people. Good times.
                        <br>
                        Click the button and come join the crew!
                    </p>

                    <a href="#" class="btn">Join The Group</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- footer section -->

<?php include './footer.php'; ?>




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