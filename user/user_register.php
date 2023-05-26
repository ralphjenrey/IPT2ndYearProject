<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/register.css">
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
                    <span class="h1 fw-bold mb-0">Sign Up</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Create your Account</h5>

                  <div class="form-outline mb-4">
                    <input name="username" type="text" id="username" class="form-control form-control-lg" required/>
                    <label class="form-label" for="username">Username</label>
                  </div>
                  <div class="form-outline mb-4">
                    <input name="email" type="email" id="email" class="form-control form-control-lg" required/>
                    <label class="form-label" for="email">Email</label>
                  </div>
                  <div class="form-outline mb-4">
                    <input name="password" type="password" id="password" class="form-control form-control-lg" required/>
                    <label class="form-label" for="password">Password</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input name="confirm_password" type="password" id="password" class="form-control form-control-lg" required/>
                    <label class="form-label" for="password">Confirm Password</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg" type="submit">Sign Up</button>
                  </div>
                  <?php 
                  include 'db-conn.php';
      // Check if the user submitted the registration form
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the user's input
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // TODO: Validate the user's input
       //If password does not match confirm_password 
    if($password !== $confirm_password) {
    echo "<span id='incorrect-pass'>Password does not match</span>";
  }else{
    // Hash the password using bcrypt
  $hashed_password = password_hash($password, PASSWORD_BCRYPT);

  // Check if the username or email already exists in the database
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM users_credentials WHERE username = ? OR email = ?");
  $stmt->execute([$username, $email]);
  $count = $stmt->fetchColumn();

  if($count > 0) {
    // If the username or email already exists, display an error message
    echo "<span id='incorrect-pass'>Username or email already exist</span>";
  } else {
    // If the username and email are available, insert the user's information into the database
    $stmt = $pdo->prepare("INSERT INTO users_credentials (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $hashed_password]);

    // Redirect the user to the login page
    header("Location: user_login.php");
    exit;
  }
  }
  
}
    ?>

                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Already have an account? <a href="user_login.php"
                      style="color: #393f81;">Login here</a></p>
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
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"
></script>
</body>
</html>

<!--
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>
  <h1>Register</h1>

  <form method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username"><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password"><br>

    <input type="submit" value="Register">
  </form>

  <a href="login.php">Already have an account? Login now!</a>

</body>
</html>
-->