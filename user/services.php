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
        <div class="col-lg-6">
          <h1>Our Services</h1>
          <h2>What We Offer</h2>
          <p>Crave offers a range of services to enhance your dining experience:</p>
          <ul>
            <li><i class="bi bi-check"></i> Easy Online Ordering: Place your orders conveniently through our website or mobile app.</li>
            <li><i class="bi bi-check"></i> Diverse Menu: Enjoy a wide variety of delicious dishes from various cuisines.</li>
            <li><i class="bi bi-check"></i> Fast Delivery: Get your food delivered right to your doorstep in no time.</li>
            <li><i class="bi bi-check"></i> Customizable Options: Personalize your orders according to your preferences.</li>
            <li><i class="bi bi-check"></i> Special Occasion Catering: We offer catering services for parties, events, and gatherings.</li>
            <li><i class="bi bi-check"></i> 24/7 Customer Support: Our dedicated support team is available round the clock to assist you.</li>
          </ul>
          <a href="index.html" class="btn btn-primary">Back to Home</a>
        </div>
        <div class="col-lg-6">
          <img class="float-end"src="https://images.unsplash.com/photo-1550029402-226115b7c579?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=465&q=80" class="img-fluid" alt="Our Services">
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

