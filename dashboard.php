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
    <header>Dashboard</header>
  <div class="d-container">
    <div class="card">
      <h2>Total Sales</h2>
      <p>5000</p>
    </div>
    <div class="card">
      <h2>Total Orders</h2>
      <p>100</p>
    </div>
    <div class="card">
      <h2>Total Products Sold</h2>
      <p>250</p>
    </div>
  </div>
  </div>

<script>
    const burger = document.querySelector('.burger');
    const close = document.querySelector('.close');
    const menu = document.querySelector('nav ul');

    burger.addEventListener('click', () => {
      menu.classList.add('open');
    burger.style.display = 'none';
    close.style.display = 'block';
  
    });

    close.addEventListener('click', () => {
        menu.classList.remove('open');
    burger.style.display = 'block';
    close.style.display = 'none';
  
});

  </script>
</body>
</html>
