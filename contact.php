<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css">
  <title>CONTACT | GRANITE STATE MISFITS</title>
  <link rel="stylesheet" href="./contact.css">
  <link rel="icon" href="./images/logo.jpeg">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>
<body>
   <!-- Navigation bar -->
   <?php include 'GSMheader.php'; ?>
<!-- Hero Section -->
<section class="contact">
  <div class="overlay"></div>
    <div class="container">
      <div class="contact-content" data-aos="fade-up"
     data-aos-duration="3000">
        <p class="contact-subtitle">GET IN TOUCH</p>
        <h1 class="contact-title">CONTACT <span>US</span></h1>
        <p class="contact-desc">Have a question, want to ride with us, or just want to say hello? We'd love to hear from you.</p>
      </div>
    </div>
  </section>

  <!-- Contact Form & Info Section -->
  <section class="contact-section">
    <div class="container grid-2">
      <!-- Left Column: Form -->
      <div>
        <h2 class="section-title">SEND US A MESSAGE</h2>
        <?php if (isset($_GET['status'])): ?>

    <?php if ($_GET['status'] == 'success'): ?>

        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check"></i>
            Your message has been sent successfully. We'll get back to you soon!
        </div>

    <?php elseif ($_GET['status'] == 'invalid_email'): ?>

        <div class="alert alert-danger">
            Please enter a valid email address.
        </div>

    <?php elseif ($_GET['status'] == 'error'): ?>

        <div class="alert alert-danger">
            Something went wrong. Please try again.
        </div>

    <?php endif; ?>

<?php endif; ?>
        <form action="contact-submit.php" method="POST">

    <div class="form-row">

        <div class="form-group">
            <input 
                type="text" 
                name="name"
                class="form-control" 
                placeholder="Your Name" 
                required
            >
        </div>

        <div class="form-group">
            <input 
                type="email" 
                name="email"
                class="form-control" 
                placeholder="Email Address" 
                required
            >
        </div>

    </div>

    <div class="form-group">
        <input 
            type="text" 
            name="subject"
            class="form-control" 
            placeholder="Subject"
        >
    </div>

    <div class="form-group">
        <textarea 
            name="message"
            class="form-control" 
            placeholder="Your Message" 
            required
        ></textarea>
    </div>

    <div class="button-1">
        <button type="submit" class="btn">
            Send Message
        </button>
    </div>

</form>
      </div>
 

      <!-- Right Column: Info -->
      <div class="info-list">
        <h2 class="section-title">GET IN TOUCH</h2>
        
        <div class="info-item">
          <div class="icon-box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#c41e3a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin-icon lucide-map-pin"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg></div>
          <div class="info-text">
            <h4>LOCATION</h4>
            <p>New Hampshire, USA<br>Granite State & Beyond</p>
          </div>
        </div>

        <div class="info-item">
          <div class="icon-box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#c41e3a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone-icon lucide-phone"><path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"/></svg></div>
          <div class="info-text">
            <h4>PHONE</h4>
            <p>(603) 555-0199<br>Mon - Fri: 9AM - 6PM</p>
          </div>
        </div>

        <div class="info-item">
          <div class="icon-box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#c41e3a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail"><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg></div>
          <div class="info-text">
            <h4>EMAIL</h4>
            <p>info@granitestatemisfits.com<br>We'll get back to you soon.</p>
          </div>
        </div>

        <div class="info-item">
          <div class="icon-box"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#c41e3a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-icon lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><path d="M16 3.128a4 4 0 0 1 0 7.744"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><circle cx="9" cy="7" r="4"/></svg></div>
          <div class="info-text">
            <h4>FOLLOW US</h4>
            <div class="social-icons-row">
              <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              <a href="#"><i class="fa-brands fa-youtube"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
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


  <!-- Where to Find Us Section -->
  <section class="map-section">
    <div class="container grid-2">
      <div>
        <h2 class="section-title">WHERE TO FIND US</h2>
        <p style="margin-bottom: 25px;">Based in New Hampshire, we ride across the most scenic roads in New England and beyond. Follow us on social media for upcoming rides and events.</p>
       <div class="button-1">
      <a href="" class="btn">View upcoming rides</a>
       </div>
      </div>
      <div class="map-box">
        <!-- Stylized Map Container -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d54423.88584749866!2d74.26397104863278!3d31.510620599999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3919056536e3a0af%3A0x7208c9ed519590ea!2sUS%20TRAVELS%20(Pvt)%20Ltd!5e0!3m2!1sen!2s!4v1785955812572!5m2!1sen!2s" width="600" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
      </div>
    </div>
  </section>

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