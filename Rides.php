<?php 
include '../Rideweb/GSM-AdminPanel/connection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <title>RIDES | GRANITE STATE MISFITS</title>
  <link rel="stylesheet" href="ride.css">
  <link rel="icon" href="./images/logo.jpeg">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">

</head>
<body>
   <?php  include 'GSMheader.php' ?>
<!-- Hero Section -->
<section class="rides">
   <div class="overlay">
  <div class="container">
    <div class="row">
      <div class="col-12 rides-content"  data-aos="fade-up"
     data-aos-duration="3000">
        <h1>Our<span> Rides</span></h1>
       <p>Check Out our Upcoming Rides and join the road crew.</p>
      </div>
    </div>
  </div>
   </div>
</section>

<!-- Rides Section -->

<section class="rides-section">
    <div class="container">
        <div class="rides-heading">
            <h2>
                FIND YOUR
                <span>RIDE</span>
            </h2>
        </div>
        <div class="row g-4">

            <?php

            $record = mysqli_query($conn, "SELECT * FROM rides");

            while ($row = mysqli_fetch_assoc($record)) {

            ?>

            <div class="col-lg-4 col-md-6">

                <div class="ride-card">

                    <!-- Ride Image -->
                    <div class="ride-image">

                        <img
                            src="./GSM-AdminPanel/Uploads/<?php echo htmlspecialchars($row['ride_image']); ?>"
                            alt="<?php echo htmlspecialchars($row['ride_name']); ?>"
                        >

                        <span class="ride-date">
                            <?php echo date('d', strtotime($row['ride_date'])); ?>

                            <small>
                                <?php echo strtoupper(date('M', strtotime($row['ride_date']))); ?>
                            </small>
                        </span>

                    </div>


                    <!-- Ride Content -->
                    <div class="ride-card-content">

                        <h3>
                            <?php echo htmlspecialchars($row['ride_name']); ?>
                        </h3>


                        <!-- Host -->
                        <p class="host">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="24"
                                 height="24"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="#c41e3a"
                                 stroke-width="2"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">

                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>

                            </svg>

                            Hosted by Road Reaper

                        </p>


                        <!-- Start Location -->
                        <p>

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="24"
                                 height="24"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="#c41e3a"
                                 stroke-width="2"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">

                                <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/>
                                <circle cx="12" cy="10" r="3"/>

                            </svg>

                            <?php echo htmlspecialchars($row['start_location']); ?>

                        </p>


                        <!-- Distance -->
                        <p>

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="24"
                                 height="24"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="#c41e3a"
                                 stroke-width="2"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">

                                <circle cx="6" cy="19" r="3"/>
                                <path d="M9 19h8.5a3.5 3.5 0 0 0 0-7h-11a3.5 3.5 0 0 1 0-7H15"/>
                                <circle cx="18" cy="5" r="3"/>

                            </svg>

                            <?php echo htmlspecialchars($row['distance']); ?>

                        </p>


                        <!-- Departure Time -->
                        <p>

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="24"
                                 height="24"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="#c41e3a"
                                 stroke-width="2"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">

                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 6v6H8"/>

                            </svg>

                            <?php echo date('g:i A', strtotime($row['departure_time'])); ?>

                        </p>


                        <!-- Difficulty -->
                        <div class="spicy-level">

                            Level:

                            <?php

                            $difficulty = strtolower($row['difficulty_level']);

                            if ($difficulty == 'easy') {
                                $peppers = 1;
                            } elseif ($difficulty == 'moderate') {
                                $peppers = 3;
                            } elseif ($difficulty == 'hard') {
                                $peppers = 5;
                            } else {
                                $peppers = 2;
                            }

                            for ($i = 1; $i <= 5; $i++) {

                                if ($i <= $peppers) {
                                    echo "<i class='fa-solid fa-pepper-hot active'></i>";
                                } else {
                                    echo "<i class='fa-solid fa-pepper-hot'></i>";
                                }

                            }

                            ?>

                        </div>


                        <!-- View Details -->
                        <a
                            href="ride-details.php?id=<?php echo $row['ride_id']; ?>"
                            class="ride-btn"
                        >
                            VIEW DETAILS
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>

                    </div>

                </div>

            </div>

            <?php

            }

            ?>

        </div>

    </div>

</section>

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