
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
    <h1>Login</h1>
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
  header("Location: dashboard.php");
  exit;
}

// Check if the user submitted the login form
// Check if the user submitted the login form
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the user's input
  $username = isset($_POST['username']) ? trim($_POST['username']) : '';
  $password = isset($_POST['password']) ? trim($_POST['password']) : '';

  // Validate the user's input
  if(empty($username) || empty($password)) {
    $errors = "Please enter username or password";
  }

  // If there are no validation errors, check if the username and password are correct
  if(empty($errors)) {
    // Hash the password using bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Check if the username and password are correct
    $stmt = $pdo->prepare("SELECT id, password FROM admin_credentials WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if($user && password_verify($password, $user['password'])) {
      // If the login is successful, store the user's ID in the session
      $_SESSION['user_id'] = $user['id'];
      header("Location: dashboard.php");
      exit;
    } else {
      // If the login fails, display an error message
      $errors = 'Incorrect username or password';
    }
  }

  // If there are validation errors, display them
  if(!empty($errors)) {
    echo '<span>'. htmlspecialchars($errors) . '</span>';
}
}

?>
    
    <div class="inputs">
  <form method="post">

    <label class="no-checkbox" for="username"></label>
    <input type="text" id="username" name="username" placeholder="Username"><br>

    <label class="no-checkbox" for="password"></label>
    <input type="password" id="password" name="password" placeholder="Password"><br>

    <input type="submit" value="Login">

    <label class="remember-margin">
    <input type="checkbox" name="item" checked/>
    <span class="text-checkbox remember-margin">Remember me</span>
    </label>
  </form>
    </div>
  <a href="register.php">Don't have an account? Register now!</a>
</div>

</div>
<!--
  <div class="box-form">
  <div class="left">
    <div class="overlay">
    <h1>Hello World.</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
    Curabitur et est sed felis aliquet sollicitudin</p>
    <span>
      <p>login with social media</p>
      <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
      <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i> Login with Twitter</a>
    </span>
    </div>
  </div>
  
  
    <div class="right">
    <h5>Login</h5>
    <p>Don't have an account? <a href="#">Creat Your Account</a> it takes less than a minute</p>
    <div class="inputs">
      <input type="text" placeholder="user name">
      <br>
      <input type="password" placeholder="password">
    </div>
      
      <br><br>
      
    <div class="remember-me--forget-password">
        
  <label>
    <input type="checkbox" name="item" checked/>
    <span class="text-checkbox">Remember me</span>
  </label>
      <p>forget password?</p>
    </div>
      
      <br>
      <button>Login</button>
  </div>
  
</div>
-->
</body>
</html>