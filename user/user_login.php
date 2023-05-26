
<?php // Check if user is already logged in
session_start();
if(isset($_SESSION['user_id'])) {
  header("Location: user-order-UI.php");
  exit;
} ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.css"
  rel="stylesheet"
/>
<link rel="stylesheet" type="text/css" href="css/login.css">
  <title></title>
</head>
<body>
<section class="vh-100" style="background: linear-gradient(135deg, #FAB2FF 10%, #1904E5 100%);">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="https://images.pexels.com/photos/5414041/pexels-photo-5414041.jpeg?auto=compress&cs=tinysrgb&w=600"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height: 100%;"/>
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">



                <form method="post">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <!-- <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i> -->
                    <span class="h1 fw-bold mb-0">Sign In</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                  <div class="form-outline mb-4">
                    <input name="username" type="text" id="username" class="form-control form-control-lg" required/>
                    <label class="form-label" for="username">Username</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input name="password" type="password" id="password" class="form-control form-control-lg" required/>
                    <label class="form-label" for="password">Password</label>
                  </div>

                  <?php
include 'db-conn.php';
// Check if the user submitted the login form
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the user's input
  $username = $_POST['username'];
  $password = $_POST['password'];

  // TODO: Validate the user's input

  // Hash the password using bcrypt
  $hashed_password = password_hash($password, PASSWORD_BCRYPT);

  // Check if the username and password are correct
  $stmt = $pdo->prepare("SELECT id, password FROM users_credentials WHERE username = ?");
  $stmt->execute([$username]);
  $user = $stmt->fetch();

  if($user && password_verify($password, $user['password'])) {
     session_start(); // Start the session
    // If the login is successful, store the user's ID in the session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $username;
    header("Location: user-order-UI.php");
    exit;
  } else {
    // If the login fails, display an error message
    echo "<span class='text-center' id='incorrect-pass'>Incorrect username or password</span>";
  }
}

?>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg" type="submit">Login</button>
                  </div>

                  <a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="user_register.php"
                      style="color: #393f81;">Register here</a></p>
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"
></script>
</body>
</html>