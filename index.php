<?php 
include '../Rideweb/GSM-AdminPanel/connection.php';


$query = "
    SELECT *
    FROM gallery
    WHERE status = 'active'
    ORDER BY gallery_id DESC Limit 4;
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <title>GRANITE STATE MISFITS</title>
  <link rel="stylesheet" href="./style.css">
  <link rel="icon" href="./images/logo.jpeg">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>
<body>
 <?php include 'GSMheader.php'; ?>

<!-- Hero Section -->
<section class="hero">
   <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-12 hero-content" data-aos="fade-up"
     data-aos-duration="3000">
        <h6>Welcome to</h6>
        <h1>Granite State <br> <span>Misfits</span></h1>
        <div class="button-1"><a href="" class="btn">Explore More</a></div>
      </div>
    </div>
  </div>
</section>

<!-- Introduction Section -->
<section class="introduction">
  <div class="container" data-aos="fade-down"
     data-aos-easing="linear"
     data-aos-duration="1500">
    <div class="row">
      <h1>Ride Hard. Ride Free.</h1>
    </div>
    <div class="row">
      <p>Granite State Misfits is a casual, no-drama motorcycle riding group for riders across New Hampshire (and welcome neighboring riders). We’re a tight-knit crew of riders who love the throttle, the twisties of the White Mountains, and the freedom of two wheels. Whether you’re a seasoned rider or just starting out—if <span>you ride hard, respect the road,</span> and value real <span>brotherhood (and sisterhood)</span>, you’re one of us. No pretenders, no posers—just misfits who ride <span>for the love of it.</span> While supporting our local communities and fellow riders.</p>
    </div>
  </div>
</section>

<!-- Benefits of Joining us -->
<section class="benefits">
  <div class="benefits-container">
    <!-- Card-1 -->
    <div class="benefit-card" data-aos="fade-up"
     data-aos-anchor-placement="top-bottom"> 
      <div class="benefit-icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#c41e3a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mountain-snow-icon lucide-mountain-snow"><path d="m8 3 4 8 5-5 5 15H2L8 3z"/><path d="M4.14 15.08c2.62-1.57 5.24-1.43 7.86.42 2.74 1.94 5.49 2 8.23.19"/></svg>
      </div>
     
      <div class="benefit-card-content">
        <h1>Scenic Rides</h1>
        <p>Unforgettable roads with hidden gems.</p>
      </div>
    </div>

     <!-- Card-2 -->
    <div class="benefit-card" data-aos="fade-up"
     data-aos-anchor-placement="top-bottom"> 
      <div class="benefit-icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#c41e3a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-icon lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><path d="M16 3.128a4 4 0 0 1 0 7.744"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><circle cx="9" cy="7" r="4"/></svg>
      </div>
     
      <div class="benefit-card-content" >
        <h1>Brotherhood</h1>
        <p>Real Connection. Real Riders.</p>
      </div>
    </div>

     <!-- Card-3 -->
    <div class="benefit-card" data-aos="fade-up"
     data-aos-anchor-placement="top-bottom"> 
      <div class="benefit-icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#c41e3a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bike-icon lucide-bike"><circle cx="18.5" cy="17.5" r="3.5"/><circle cx="5.5" cy="17.5" r="3.5"/><circle cx="15" cy="5" r="1"/><path d="M12 17.5V14l-3-3 4-3 2 3h2"/></svg>
      </div>
     
      <div class="benefit-card-content">
        <h1>Respect</h1>
        <p>Respect the road & each other.</p>
      </div>
    </div>

     <!-- Card-4 -->
    <div class="benefit-card" data-aos="fade-up"
     data-aos-anchor-placement="top-bottom"> 
      <div class="benefit-icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#c41e3a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check-icon lucide-shield-check"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
      </div>
     
      <div class="benefit-card-content">
        <h1>No Drama</h1>
        <p>No politics, no ego. Just good people.</p>
      </div>
    </div>

     <!-- Card-5 -->
    <div class="benefit-card card-5" data-aos="fade-up"
     data-aos-anchor-placement="top-bottom"> 
      <div class="benefit-icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#c41e3a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-hand-heart-icon lucide-hand-heart"><path d="M11 14h2a2 2 0 0 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 16"/><path d="m14.45 13.39 5.05-4.694C20.196 8 21 6.85 21 5.75a2.75 2.75 0 0 0-4.797-1.837.276.276 0 0 1-.406 0A2.75 2.75 0 0 0 11 5.75c0 1.2.802 2.248 1.5 2.946L16 11.95"/><path d="m2 15 6 6"/><path d="m7 20 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a1 1 0 0 0-2.75-2.91"/></svg>
      </div>
     
      <div class="benefit-card-content">
        <h1>Give Back</h1>
        <p>Supporting our local cmmunities & riders.</p>
      </div>
    </div>

  </div>
</section>

<section class="about my-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-6" data-aos="zoom-out">
        <div class="row about-content mt-2">
          <h1><span>About</span> The Group</h1>
          <p>Granite State Misfits is a casual, no-drama motorcycle riding group for riders across New Hampshire. <br>It’s not a formal club, MC, RC, business, or organization—just a loose crew of riders who want to organize rides, find riding buddies, and enjoy the roads without rules, dues, politics, or structure.  </p>
           
        </div>
      </div>


      <div class="col-lg-6 p-3">
        <!-- Image Slider -->
    <div class="image-slider">
      <input type="radio" name="slider" id="slide1" checked>
      <input type="radio" name="slider" id="slide2">
      <input type="radio" name="slider" id="slide3">
      
      <div class="slides">
          <div class="slide first">
              <img src="./images/slider-img-1.jfif" alt="Bike Ride">
          </div>

          <div class="slide">
              <img src="./images/slider-img-2.jfif" alt="Mountain Ride">
          </div>

          <div class="slide">
              <img src="./images/slider-img-3.jfif" alt="Road Ride">
          </div>
      </div>


      <!-- Dots -->
      <div class="dots">

          <label for="slide1"></label>
          <label for="slide2"></label>
          <label for="slide3"></label>

                </div>
             </div>

        </div>
    </div>
  </div>
</section>


<!-- upcoming rides -->
<section class="upcoming-rides">
    <div class="row">
        <h1>Upcoming <span>Rides</span></h1>
    </div>

    <div class="card-container">

        <?php
        $record = mysqli_query($conn, "SELECT * FROM rides WHERE status = 'upcoming'");

        if (mysqli_num_rows($record) > 0) {

            while ($row = mysqli_fetch_assoc($record)) {
        ?>

        <div class="card" data-aos="zoom-out-down">

            <div class="date">
                <span class="ride-date">
                    <?php echo date('d', strtotime($row['ride_date'])); ?>

                    <small>
                        <?php echo strtoupper(date('M', strtotime($row['ride_date']))); ?>
                    </small>
                </span>
            </div>

            <img 
                src="./GSM-AdminPanel/Uploads/<?php echo htmlspecialchars($row['ride_image']); ?>"
                alt="<?php echo htmlspecialchars($row['ride_name']); ?>"
            >

            <div class="card-content">

                <h1>
                    <?php echo htmlspecialchars($row['ride_name']); ?>
                </h1>

                <div class="timings">

                    <div class="distance">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="#c41e3a"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-land-plot-icon lucide-land-plot">
                            <path d="m12 8 6-3-6-3v10"/>
                            <path d="m8 11.99-5.5 3.14a1 1 0 0 0 0 1.74l8.5 4.86a2 2 0 0 0 2 0l8.5-4.86a1 1 0 0 0 0-1.74L16 12"/>
                            <path d="m6.49 12.85 11.02 6.3"/>
                            <path d="M17.51 12.85 6.5 19.15"/>
                        </svg>

                        <?php echo htmlspecialchars($row['distance']); ?>
                    </div>

                    <div class="departure">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="#c41e3a"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-clock-fading-icon lucide-clock-fading">
                            <path d="M12 2a10 10 0 0 1 7.38 16.75"/>
                            <path d="M12 6v6l4 2"/>
                            <path d="M2.5 8.875a10 10 0 0 0-.5 3"/>
                            <path d="M2.83 16a10 10 0 0 0 2.43 3.4"/>
                            <path d="M4.636 5.235a10 10 0 0 1 .891-.857"/>
                            <path d="M8.644 21.42a10 10 0 0 0 7.631-.38"/>
                        </svg>

                        <?php echo htmlspecialchars($row['departure_time']); ?>
                    </div>

                </div>

                <p>Twisties, overlook and good eats.</p>

            </div>
        </div>

        <?php
            }

        } else {
            echo '<p class="no-rides">No upcoming rides available.</p>';
        }
        ?>

    </div>

    <a href="rides.php" class="btn">
        View All Rides

        <svg xmlns="http://www.w3.org/2000/svg"
            width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            stroke="#c41e3a"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="lucide lucide-move-right-icon lucide-move-right">
            <path d="M18 8L22 12L18 16"/>
            <path d="M2 12H22"/>
        </svg>
    </a>

</section>


<section class="join-us">
    <div class="container">
        <div class="row justify-content-end">
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

 <!-- Gallery section -->
 <!-- Gallery Section -->
<section class="gallery">

    <div class="row text-center">
        <h1>From the <span>road</span></h1>
    </div>

    <div class="container">

        <?php if ($result && mysqli_num_rows($result) > 0): ?>

            <?php while ($gallery = mysqli_fetch_assoc($result)): ?>

                <div class="card">
                    <img 
                        src="./GSM-AdminPanel/Uploads/gallery/<?php echo htmlspecialchars($gallery['image_name']); ?>"
                        alt="<?php echo htmlspecialchars($gallery['title'] ?? 'Gallery Image'); ?>"
                    >
                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <p class="no-gallery">No gallery images available.</p>

        <?php endif; ?>

    </div>

    <a href="gallery.php" class="btn">
        View Full Gallery

        <svg xmlns="http://www.w3.org/2000/svg"
             width="24"
             height="24"
             viewBox="0 0 24 24"
             fill="none"
             stroke="#c41e3a"
             stroke-width="1.5"
             stroke-linecap="round"
             stroke-linejoin="round">

            <path d="M18 8L22 12L18 16"/>
            <path d="M2 12H22"/>

        </svg>
    </a>

</section>


<!-- footer section -->


<?php include 'footer.php'; ?>

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