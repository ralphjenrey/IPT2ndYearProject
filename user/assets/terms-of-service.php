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
  <meta charset="utf-8"5rthrthrt>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Crave</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="vy5jhyjy5thttps://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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

<!-- Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
          try{
          include 'db-conn.php';
          // Query to fetch order details
          $stmt = $pdo->prepare("SELECT * FROM orders");
          $stmt->execute();
          $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

          // Loop through each order and display the information
          foreach ($orders as $order) {
            echo "<div class='row'>";
          echo "<div class='col'>";
          echo "<p class='text-dark fs-6'>Order ID: " . $order['order_id'] . "</p>";
          echo "</div>";
          echo "<div class='col'>";
          echo "<p class='text-dark'>" . $order['customer_name'] . "</p>";
          echo "</div>";
          echo "<div class='col'>";
          echo "<p class='text-dark'>Quantity: " . $order['order_status'] . "</p>";
          echo "</div>";
          echo "<div class='col'>";
          echo "<p class='text-dark'>Total: $" . $order['total'] . "</p>";
          echo "</div>";
          echo "</div>";
          echo "<hr class='my-2'>";
          }
        } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
        }

        // Close the database connection
        $conn = null;
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Check out</button>
      </div>
    </div>
  </div>
</div>


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

  
  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>Food Crave</h3>
              <p>
                Cebu Eastern College <br>
                Cebu City, Philippines<br><br>
                <strong>Phone:</strong> +63 9057331813<br>
                <strong>Email:</strong> none@gmail.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="user-order-UI.php">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="about-us.php">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="services.php">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="terms-of-service.php">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="private-policy.php">Privacy policy</a></li>
            </ul>
          </div>

          

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Food Crave</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/restaurantly-restaurant-template/ -->
        Designed by <a href="https://bootstrapmade.com/">Everyone</a>
      </div>
    </div>
  </footer><!-- End Footer -->

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

