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
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between ">
    <h1 class="logo me-auto me-lg-0"><a href="index.html">Crave</a></h1>

    <nav id="navbar" class="navbar order-last order-lg-0">
      <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
        </ul>
      <button class="navbar-toggler mobile-nav-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </nav>

    <button type="button" class="book-a-table-btn" data-bs-toggle="modal" data-bs-target="#cartModal">
  Cart
</button>
    <div class="dropdown">
      <a class="dropdown-toggle text-white" href="#" role="button" id="usernameDropdown" data-bs-toggle="dropdown" aria-expanded="false">

        <?php 
        include 'db-conn.php';
        echo $_SESSION['username']; 
        $pdo = null;
        ?>
      </a>
      <ul class="dropdown-menu" aria-labelledby="usernameDropdown">
        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</header><!-- End Header -->

<!-- Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
        // Include the db-conn.php file for database connection
        include 'db-conn.php';
        if (isset($_SESSION['username'])) {
          $username = $_SESSION['username'];

          // Retrieve the cart items for the current user
          try {
            // Prepare the SQL statement to fetch cart items
            $stmt = $pdo->prepare("SELECT item_name, item_price, item_quantity, item_total FROM users_cart WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            // Check if any items are found
            if ($stmt->rowCount() > 0) {
              echo '<table class="table">
                      <thead>
                        <tr>
                          <th>Item Name</th>
                          <th>Item Price</th>
                          <th>Item Quantity</th>
                          <th>Item Total</th>
                        </tr>
                      </thead>
                      <tbody>';

              // Loop through the cart items and display them
              while ($row = $stmt->fetch()) {
                $itemName = $row['item_name'];
                $itemPrice = $row['item_price'];
                $itemQuantity = $row['item_quantity'];
                $itemTotal = $row['item_total'];

                echo '<tr>
                        <td>' . $itemName . '</td>
                        <td>' . $itemPrice . '</td>
                        <td>' . $itemQuantity . '</td>
                        <td>' . $itemTotal . '</td>
                      </tr>';
              }

              echo '</tbody>
                    </table>';
            } else {
              echo '<p>No items in the cart.</p>';
            }
          } catch (PDOException $e) {
            // Output an error message
            echo "Error: " . $e->getMessage();
          }

          // Close the database connection
          $conn = null;
        } else {
          echo '<p>Please log in to view the cart.</p>';
        }
        ?>

        <div class="d-flex justify-content-between mb-2">
          <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Save for Later</button>
          <a type="button" class="btn btn-primary" href="check-out.php">Check out</a>
        </div>

      </div>
    </div>
  </div>
</div>


 <!-- ======= Menu Section ======= -->
<section id="hero" class="d-flex">
  <div class="container">
    <div class="row">
      <!-- Sidebar -->
     <div class="col-lg-3">
  <div class="sidebar">
    <div class="list-group filters-list-group">
      <div class="search-container">
        <div class="row">
          <div class="col-9 col-md-8">
            <div class="input-group">
              <input type="text" id="searchInput" class="form-control" placeholder="Search...">
            </div>
          </div>
          <div class="col-3 col-md-4">
             <button type="submit" class="btn btn-primary" onclick="searchItems()"><i class="bx bx-search"></i></button>
          </div>
        </div>
      </div>
      <li class="list-group-item" data-filter="*">All</li>
      <li class="list-group-item" data-filter="apple">Apple</li>
      <li class="list-group-item" data-filter="xiaomi">Xiaomi</li>
      <li class="list-group-item" data-filter="vivo">Vivo</li>
      <li class="list-group-item" data-filter="oppo">Oppo</li>
      <li class="list-group-item" data-filter="samsung">Samsung</li>
      <li class="list-group-item" data-filter="lenovo">Lenovo</li>
    </div>
  </div>
</div>


      <!-- Item List -->

          <!-- Your item list goes here -->
            <div class="col-lg-9">
        <div class="row">
          <?php
          include 'db-conn.php';
    try {

      // Create a new PDO instance
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

      // Set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Prepare the SQL statement to select data from the "items" table
      $stmt = $conn->prepare("SELECT * FROM items");

      // Execute the SQL statement
      $stmt->execute();

      // Loop through the result set and output each item
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="col-lg-3 col-md-6 col-sm-6 col-6 align-items-center">';
  echo '<div class="item text-center ' . strtolower($row['item_variant']) . '">';
  echo '<div class="item-image">';
  echo '<img src="' . '../admin/'.$row['item_picture'] . '" alt="' . $row['item_name'] . '" class="img-fluid" width="100%" height="auto">';
  echo '</div>';
  echo '<h3 class="item-name fs-5">' . $row['item_name'] . '</h3>';
  echo '<p class="item-price">₱' . $row['item_price'] . '</p>'; // Added line for item price
  echo '<div class="input-group mb-2">';
  echo '<button class="btn btn-outline-secondary decrement" type="button">-</button>';
  echo '<input type="text" class="form-control counter-input text-center" value="0" readonly>';
  echo '<input type="hidden" name="item_id" value="' . $row['item_id'] . '">';
  echo '<button class="btn btn-outline-secondary increment" type="button">+</button>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
      }
   
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $conn = null;
    ?>
            <button class="btn btn-primary add-to-cart-btn" type="button">Add to Cart</button>
            </div>
          </div>
</section>

<!-- Menu Hero -->

  
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