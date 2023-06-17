 <?php
 session_start();


// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: user_login.php");
  exit;

}
          include 'db-conn.php';
          
          $username = $_SESSION['username'];

    // Prepare the query
    $query = "SELECT * FROM users_cart WHERE username = :username";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':username', $username);
    
    // Execute the query
    $statement->execute();
// Count the number of rows in the result set
    $cartItemCount = $statement->rowCount();
?>
<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Checkout Page</title>

    

    <!-- Bootstrap core CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="assets/css/checkout.css">


</head>
<body id="hero">
<div class="container">
  <main>
    <div class="py-5 text-center d-flex">
      <div>
         <a href="user-order-UI.php" class="btn btn-primary">Change Order</a> <!-- Back button -->
      </div>
  <h1 class="text-white">Checkout form</h1>
</div>

    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Your cart</span>
          <span class="badge bg-primary rounded-pill"><?php echo $cartItemCount ?></span>
        </h4>
        <ul class="list-group mb-3">
          <?php


    // Check if the query was successful
    if ($statement->rowCount() > 0) {
    // Fetch all rows from the result set
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
                        // Fetch cart items from the database and store them in $rows variable
                        $totalPrice = 0;
                        foreach ($rows as $row) {
                            ?>
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0"><?php echo $row['item_name']; ?></h6>
                                    <small class="text-muted">Quantity: <?php echo $row['item_quantity']; ?></small>
                                </div>
                                <span class="text-muted">₱<?php echo $row['item_total']; 
                                $totalPrice += $row['item_total'];
                              ?></span>
                            </li>
                            <?php
                        }
                      }
                        ?>
          <!-- <li class="list-group-item d-flex justify-content-between bg-light">
             <div class="text-success">
              <h6 class="my-0">Promo code</h6>
              <small>EXAMPLECODE</small>
            </div> 
            <span class="text-success">−$5</span>
          </li> -->
          <li class="list-group-item d-flex justify-content-between">
            <span>Total</span>
            <strong>₱<?php echo $totalPrice; ?></strong>
          </li>
        </ul>

        <!-- <form class="card p-2">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Promo code">
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </form> -->
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3 text-white">Billing address</h4>
        <?php
        
       // Retrieve form data if it is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  include 'db-conn.php';
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $address2 = $_POST['address2'];
  $country = $_POST['country'];
  $state = $_POST['state'];
  $zip = $_POST['zip'];
  $paymentMethod = $_POST['paymentMethod'];
  $cardName = $_POST['cc-name'];
  $cardNumber = $_POST['cc-number'];
  $cardExpiration = $_POST['cc-expiration'];
  $cardCVV = $_POST['cc-cvv'];
  $totalPrice = $totalPrice; // Assuming the variable $totalPrice is calculated correctly in the existing code

  // Prepare the INSERT statement
  $query = "INSERT INTO orders (order_status, username, first_name, last_name, email, address, address2, country, state, zip, payment_method, card_name, card_number, card_expiration, card_cvv, total_price) 
            VALUES (:orderStatus, :username, :firstName, :lastName, :email, :address, :address2, :country, :state, :zip, :paymentMethod, :cardName, :cardNumber, :cardExpiration, :cardCVV, :totalPrice)";
  $statement = $pdo->prepare($query);

  // Bind the form data to the statement parameters
  $statement->bindValue(':orderStatus', 'Pending'); // Set the order status to 'Pending' (or any other appropriate value)
  $statement->bindValue(':username', $_SESSION['username']);
  $statement->bindValue(':firstName', $firstName);
  $statement->bindValue(':lastName', $lastName);
  $statement->bindValue(':email', $email);
  $statement->bindValue(':address', $address);
  $statement->bindValue(':address2', $address2);
  $statement->bindValue(':country', $country);
  $statement->bindValue(':state', $state);
  $statement->bindValue(':zip', $zip);
  $statement->bindValue(':paymentMethod', $paymentMethod);
  $statement->bindValue(':cardName', $cardName);
  $statement->bindValue(':cardNumber', $cardNumber);
  $statement->bindValue(':cardExpiration', $cardExpiration);
  $statement->bindValue(':cardCVV', $cardCVV);
  $statement->bindValue(':totalPrice', $totalPrice);

  // Execute the INSERT statement
  $statement->execute();
  $pdo = null;
}
        ?>
        <form class="needs-validation" id="myForm" method="post" novalidate>
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">First name</label>
              <input type="text" class="form-control" id="firstName"  name="firstName" placeholder="" value="" required="">
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Last name</label>
              <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="" required="">
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>

            <div class="col-12">
              <label for="username" class="form-label">Username</label>
              <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $_SESSION['username']; ?>" readonly>
                <div class="invalid-feedback">
                  Your username is required.
                </div>
              </div>
            </div>

            <div class="col-12">
              <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
              <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required="">
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="col-12">
              <label for="address2" class="form-label">Address 2 <span class="text-muted">(Optional)</span></label>
              <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment or suite">
            </div>

            <div class="col-md-5">
              <label for="country" class="form-label">Country</label>    
              <select class="form-select" onchange="print_state('state',this.selectedIndex);" id="country" name ="country" required></select>
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
            </div>

            <div class="col-md-4">
              <label for="state" class="form-label">State</label>
              <select class="form-select" name ="state" id ="state" required></select>
              <div class="invalid-feedback">
                Please provide a valid state.
              </div>
            </div>

            <div class="col-md-3">
              <label for="zip" class="form-label">Zip</label>
              <input type="text" class="form-control" id="zip" name="zip" placeholder="" required="">
              <div class="invalid-feedback">
                Zip code required.
              </div>
            </div>
          </div>

          <hr class="my-4">

          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="same-address">
            <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
          </div>

          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="save-info">
            <label class="form-check-label" for="save-info">Save this information for next time</label>
          </div>

          <hr class="my-4">

          <h4 class="mb-3">Payment</h4>

          <div class="my-3">
            <div class="form-check">
              <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked="" required="">
              <label class="form-check-label" for="credit">Credit card</label>
            </div>
            <div class="form-check">
              <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required="">
              <label class="form-check-label" for="debit">Debit card</label>
            </div>
            <div class="form-check">
              <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required="">
              <label class="form-check-label" for="paypal">PayPal</label>
            </div>
          </div>

          <div class="row gy-3">
            <div class="col-md-6">
              <label for="cc-name" class="form-label">Name on card</label>
              <input type="text" class="form-control" id="cc-name" name="cc-name" placeholder="" required="">
              <small class="text-muted">Full name as displayed on card</small>
              <div class="invalid-feedback">
                Name on card is required
              </div>
            </div>

            <div class="col-md-6">
      <label for="cc-number" class="form-label">Credit card number</label>
      <input type="text" class="form-control" id="cc-number" name="cc-number" placeholder="13 digits" pattern="[0-9]{13,16}" required>
      <div class="invalid-feedback">
        Credit card number is required
      </div>
    </div>

    <div class="col-md-3">
      <label for="cc-expiration" class="form-label">Expiration</label>
      <input type="text" class="form-control" id="cc-expiration" name="cc-expiration" placeholder="04/22" pattern="(0[1-9]|1[0-2])\/[0-9]{2}" required>
      <div class="invalid-feedback">
        Expiration date required
      </div>
    </div>

    <div class="col-md-3">
      <label for="cc-cvv" class="form-label">CVV</label>
      <input type="text" class="form-control" id="cc-cvv" name="cc-cvv" placeholder="3 digits" pattern="[0-9]{3,4}" required>
      <div class="invalid-feedback">
        Security code required
      </div>
    </div>

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Order now</button>
        </form>
      </div>
    </div>
  </main>
</div>
</section>


    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script type= "text/javascript" src = "assets/js/countries.js"></script>
      <script language="javascript">print_country("country");</script>
      <script language="javascript">print_state("state");</script>
      <script src="form-validation.js"></script>
  

<div id="loom-companion-mv3" ext-id="liecbddmkiiihnedobmlmillhodjkdmb"><section id="shadow-host-companion"></section></div></body></html>