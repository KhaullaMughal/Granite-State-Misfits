<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <title>GRANITE STATE MISFITS</title>
  <link rel="stylesheet" href="./faq.css">
  <link rel="icon" href="./images/logo.jpeg">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>
<body>
   <!-- Navigation bar -->
   <?php include 'GSMheader.php'; ?>

<!-- Hero Section -->
<section class="hero">
   <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-12 hero-content" data-aos="fade-up"
     data-aos-duration="3000">
        <h1>Frequently Asked <br> <span>Questions</span></h1>
        <p>Everthing you need to know about Granite State Misfits, our rides and our community</p>
        <div class="button-1"><a href="" class="btn">Explore More</a></div>

      </div>
    </div>
  </div>
</section>


<!-- ================= OUR JOURNEY ================= -->

<section class="journey py-5">
    <div class="container">

        <div class="section-title text-center mb-5">
            <h5>OUR JOURNEY</h5>
            <h2>Every Ride Has A Story</h2>
            <p>
                From a small group of passionate riders to a growing brotherhood,
                every milestone has been driven by friendship, adventure, and respect.
            </p>
        </div>

        <div class="timeline">

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span>General</span>
                    <h4>Who are Granite State Misfits?</h4>
                    <p>
                       We are a casual, no-drama motorcycle riding group based in New Hampshire.
                      We welcome riders who enjoy scenic rides, good company, and respect for fellow riders.
                    </p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span>Rides</span>
                    <h4>How do I join a ride?</h4>
                    <p>
                        Simply check our Upcoming Rides section, select an event, and follow the registration instructions.
                    </p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span>Safety</span>
                    <h4>Is wearing a helmet required?</h4>
                    <p>
                       We strongly encourage every rider and passenger to wear DOT-approved safety gear.

                    </p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span>Membership</span>
                    <h4>How can I become a member?</h4>
                    <p>
                       Click the Join the Group button and complete the membership form. It's free!
                    </p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span>Bike & Gear</span>
                    <h4>Do I need a specific type of motorcycle?</h4>
                    <p>
                       No. All makes, models, and styles are welcome as long as your bike is roadworthy and legal to ride.
                    </p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <span>Contact</span>
                    <h4>How can I contact Granite State Misfits?</h4>
                    <p>
                       You can reach us through our Contact page or email us directly. We'll get back to you soon!
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>

<section class="questions">
  <div class="container">
    <div class="row">
      <h1>Still have <span>questions?</span></h1>
      <p>We're here to help! Reach out anytime.</p>
    </div>
    <div class="row button">
      <a href="./contact.php" class="btn">Contact us</a>
    </div>
  </div>
</section>

<!-- Join Us Section -->
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

                    <a href="./contact.php" class="btn">Join The Group</a>
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