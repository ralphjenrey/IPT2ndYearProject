<?php
session_start();

// Connect to the database
$host = 'localhost';
$dbname = 'my_database';
$username = 'root';
$password = '';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
  die("Error connecting to the database: " . $e->getMessage());
}

// Check if user is already logged in
if(isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit;
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/register.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <title></title>
</head>
<body>
      <div class="box-form">
    <div class="left">
    <div class="overlay">
    <h1>Admin Management</h1>
    <p>Order management and Inventory tracker</p>
    <span>
      <p>login with social media</p>
      <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
      <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
    </span>
    </div>
  </div>
  

  <div class="right">
    <h1>Register</h1>
    <?php 
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
    echo "<span id='incorrect-pass'>Incorrect username or password</span>";
  }else{
    // Hash the password using bcrypt
  $hashed_password = password_hash($password, PASSWORD_BCRYPT);

  // Check if the username or email already exists in the database
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
  $stmt->execute([$username, $email]);
  $count = $stmt->fetchColumn();

  if($count > 0) {
    // If the username or email already exists, display an error message
    echo "<span id='incorrect-pass'>Username or email already exist</span>";
  } else {
    // If the username and email are available, insert the user's information into the database
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $hashed_password]);

    // Redirect the user to the login page
    header("Location: login.php");
    exit;
  }
  }
  
}
    ?>
     <div class="inputs">
  <form method="post">

    <label class="no-checkbox" for="username"></label>
    <input type="text" id="username" name="username" placeholder="Username" required><br>

     <label class="no-checkbox" for="email"></label>
    <input type="email" id="email" name="email" placeholder="Email adddress" required><br>

    <label class="no-checkbox" for="password"></label>
    <input type="password" id="password" name="password" placeholder="Password" required><br>

    <label class="no-checkbox" for="confirm_paassword"></label>
    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password" required><br>

    <input type="submit" value="Login">

    <label class="remember-margin">
    <input type="checkbox" name="item" checked/>
    <span class="text-checkbox remember-margin">Remember me</span>
    </label>
  </form>
    </div>
  <a href="login.php"><span>Don't have an account? Register now!</span></a>
</div>

</div>
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