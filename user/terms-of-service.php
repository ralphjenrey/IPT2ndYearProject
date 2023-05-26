 <?php
      session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: user_login.php");
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Crave</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/animate.css@3.7.2/animate.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
<link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/swiper@6.8.4/swiper-bundle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">



  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/user-order-UI.css" rel="stylesheet">
</head>

<body>
  <?php include 'header.php' ?>



  <!-- ======= Main Section ======= -->
  <section id="main" class="d-flex align-items-center nav-section">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <div class="col-lg-12">
          <h1>Terms of Service</h1>
          <p>Please read these terms and conditions carefully before using our website.</p>
          <h2>1. Acceptance of Terms</h2>
          <p>By accessing or using our website, you agree to be bound by these terms and conditions. If you do not agree with any part of these terms and conditions, you must not use our website.</p>
          <h2>2. Use of Our Website</h2>
          <p>You must use our website only for lawful purposes and in accordance with these terms and conditions. You are prohibited from using our website for any illegal or unauthorized purpose.</p>
          <h2>3. Intellectual Property Rights</h2>
          <p>All content and materials available on our website, including but not limited to text, graphics, logos, images, and software, are the intellectual property of Food Crave and are protected by applicable intellectual property laws.</p>
          <h2>4. Limitation of Liability</h2>
          <p>In no event shall Food Crave or its affiliates be liable for any indirect, consequential, incidental, special, or punitive damages arising out of or in connection with your use of our website.</p>
          <h2>5. Governing Law</h2>
          <p>These terms and conditions shall be governed by and construed in accordance with the laws of [your country].</p>
          <h2>6. Changes to the Terms and Conditions</h2>
          <p>We reserve the right to modify or replace these terms and conditions at any time without prior notice. By continuing to use our website after any revisions become effective, you agree to be bound by the revised terms and conditions.</p>
          <a href="index.html" class="btn btn-primary">Back to Home</a>
        </div>
      </div>
    </div>
  </section><!-- End Main Section -->

  
  <!-- Footer Section -->
  <?php include 'footer.php'; ?>

  <div id="preloader" class="d-flex align-items-center justify-content-center">
  <span class="preloader-text display-1">C R A V E</span>
</div>
  </div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><img width="50" height="30" src="https://img.icons8.com/ios-filled/50/FFFFFF/up--v1.png" alt="up--v1"/></a>
  <!-- Template Main JS File -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@6.8.4/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/php-email-form@3.1.1/dist/validate.js"></script>

<script src="assets/js/main.js"></script>
<script src="assets/js/user-order.js"></script>
</body>

</html>

