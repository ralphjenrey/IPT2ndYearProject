<?php
include 'admin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head >
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
</head>

<body>

  <div class="dashboard-container">
    <header class="bg-dark text-white text-center fs-4">Dashboard</header>
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
