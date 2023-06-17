<?php
include 'admin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css">
</head>

<body>

  <div class="dashboard-container">
    <header class="bg-dark text-white text-center fs-4">Dashboard</header>
  <div class="d-container mt-5">
    <div class="row">
      <div class="col">
        <h2 class="text-center">Sales Tracker</h2>
        <canvas id="myChart" width="400" height="200"></canvas>
      </div>
    </div>
  </div>
  </div>


  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.2/dist/chart.min.js"></script>
  <script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Total Sales', 'Total Orders', 'Total Products Sold'],
        datasets: [{
          label: 'Sales Tracker',
          data: [5000, 100, 250],
          fill: false,
          borderColor: 'rgba(75, 192, 192, 1)',
          tension: 0.1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
</body>
</html>
</body>
</html>
