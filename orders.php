<?php
  include 'admin.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Order Management</title>
    <link rel="stylesheet" type="text/css" href="css/orders.css">
  </head>
  <body>
    <div class="dashboard-container">
       <header>Order Management</header>
    <table>
      <thead>
        <tr>
          <th>Details</th>
          <th>Status</th>
          <th>Customer Name</th>
          <th>Order ID</th>
          <th>Profit</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <div class="dropdown">
              <button onclick="showDetails(this)">Details</button>
              <div class="dropdown-content"></div>
            </div>
          </td>
          <td>Processing</td>
          <td>John Doe</td>
          <td>001</td>
          <td>50</td>
          <td>$500</td>
        </tr>
        <tr>
          <td>
            <div class="dropdown">
              <button onclick="showDetails(this)">Details</button>
              <div class="dropdown-content"></div>
            </div>
          </td>
          <td>Shipped</td>
          <td>Jane Smith</td>
          <td>002</td>
          <td>75</td>
          <td>600</td>
        </tr>
        <tr>
          <td>
            <div class="dropdown">
              <button onclick="showDetails(this)">Details</button>
              <div class="dropdown-content"></div>
            </div>
          </td>
          <td>Delivered</td>
          <td>Bob Johnson</td>
          <td>003</td>
          <td>100</td>
          <td>800</td>
        </tr>
      </tbody>
    </table>
    </div>
   

    <script>
      function showDetails(button) {
        const row = button.parentNode.parentNode;
        const dropdownContent = row.querySelector(".dropdown-content");
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
          return;
        }
        const itemImage = "image.jpg"; // Replace with actual item image URL
        const itemName = "Item name"; // Replace with actual item name
        const itemQuantity = 10; // Replace with actual item quantity
        const itemPrice = "$50"; // Replace with actual item price
        const profit = "$20" // Replace with actual profit value
        const itemTotalPrice = "$500"; // Replace with actual item total price
        const table = `
          <table>
            <thead>
              <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Profit</th>
                <th>Total Price</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><img src="${itemImage}" alt="Item Image" width="50"></td>
                <td>${itemName}</td>
                <td>${itemQuantity}</td>
                <td>${itemPrice}</td>
                <td>${profit}</td>
                <td>${itemTotalPrice}</td>
              </tr>
            </tbody>
          </table>
        `;
        dropdownContent.innerHTML = table;
        dropdownContent.style.display = "block";
      }
    </script>

  </body>
</html>

