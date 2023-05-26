<?php
session_start();

// Check if the user is logged in
if(!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

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

// Get the user's information from the database
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head >
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" type="text/css" href="css/profile.css">
</head>

<body>

 <nav>
    <h1>Admin Dashboard</h1>
    <div class="container">
    <h1>Welcome, <?php echo $user['username']; ?>!</h1>
  <p>You are now logged in as an admin.</p>
  </div>

    <div class="menu">
      <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="orders.php">Order Management</a></li>
        <li><a href="inventory.php">Inventory</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
      <span class="burger">&#9776;</span>
      <span class="close">&times;</span>
    </div>
  </nav>

  <div class="dashboard-container">
    <header>Profile</header>
<?php
  if(isset($_POST['update_password'])) {
  // Get the user's input
  $current_password = $_POST['current_password'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  // TODO: Validate the user's input

  // Check if the current password is correct
  $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
  $stmt->execute([$_SESSION['user_id']]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if(password_verify($current_password, $user['password'])) {
    // Hash the new password using bcrypt
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    // Update the user's password in the database
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->execute([$hashed_password, $_SESSION['user_id']]);

    // Display a success message
    echo "Password updated successfully";
  } else {
    // If the current password is incorrect, display an error message
    echo "Current password is incorrect";
  }
}
?>

  <form method="post">
    <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
  <p><strong>Email:</strong> <?php echo $user['email']; ?></p>

  <h2 class="toggle-button">Change Password</h2>
  <div class="toggle">
     
  <label for="current_password">Current Password:</label>
  <input type="password" id="current_password" name="current_password"><br>

<label for="new_password">New Password:</label>
<input type="password" id="new_password" name="new_password"><br>

<label for="confirm_password">Confirm New Password:</label>
<input type="password" id="confirm_password" name="confirm_password"><br>
<input type="submit" name="update_password" value="Update Password">
  </div>
 

  <h2 class="toggle-button">Change Profile Picture</h2>
  <div class="toggle">
    <form method="post" enctype="multipart/form-data">
    <input type="file" name="profile_picture"><br>

    <input type="submit" value="Change Profile Picture">
  </div>
  

</form>
</div>

</body>
</html>

<script>
  // get all toggle buttons
  const toggleButtons = document.querySelectorAll('.toggle-button');

  // add click event listener to each toggle button
  toggleButtons.forEach(button => {
    button.addEventListener('click', () => {
      // get the corresponding toggle element
      const toggle = button.nextElementSibling;

      // toggle the class 'active' on the toggle element
      toggle.classList.toggle('active');
    });
  });
</script>

</body>
</html>
