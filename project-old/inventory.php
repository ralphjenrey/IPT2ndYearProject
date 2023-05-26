<?php
  // database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

// create database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// check if connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// check if form is submitted
if (isset($_POST["submit"])) {
    // get form data
    $item_name = $_POST["item-name"];
    $item_quantity = $_POST["item-quantity"];
    $item_price = $_POST["item-price"];
    $item_net_price = $_POST["item-net-price"];
    $item_picture = $_FILES["item-picture"]["name"];

    // upload item picture to server
    move_uploaded_file($_FILES["item-picture"]["tmp_name"], "uploads/" . $item_picture);

    // insert data into database
    $sql = "INSERT INTO items (item_picture, name, item_quantity, price, net_price) 
            VALUES ( '$item_picture','$item_name', '$item_quantity', '$item_price', '$item_net_price')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// close database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Order Management</title>
    <link rel="stylesheet" type="text/css" href="css/inventory.css">
  </head>
  <body>
    <div class="dashboard-container">
       <header>
        <div class="menu-container">
          <button type="button" class="inventory-menu">Menu</button>Inventory Management
        <div class="menu-dropdown">
          <ul>
            <li><button>Add Item</button></li>
            <li><button>Search</button></li>
          </ul>
        </div>
        </div>
       </header>
    <div class="item-container">
      <div class="add-container">
        <form method="post" enctype="multipart/form-data">
  <label for="item-name">Item Name:</label>
  <input type="text" id="item-name" name="item-name">

  <label for="item-quantity">Item Quantity:</label>
  <input type="number" id="item-quantity" name="item-quantity">

  <label for="item-price">Item Price:</label>
  <input type="number" id="item-price" name="item-price">

  <label for="item-net-price">Item Net Price:</label>
  <input type="number" id="item-net-price" name="item-net-price">

  <label for="item-picture">Item Picture:</label>
  <input type="file" id="item-picture" name="item-picture">

  <input type="submit" name="submit">
</form>

  </div>

      <div class="search-container">
        <div class="form-group">
    <label for="item-name">Item Name:</label>
    <input type="text" id="item-name" name="item-name">
  </div>
  <div class="form-group">
    <label for="item-id">Item Id:</label>
    <input type="number" id="item-price" name="item-price">
  </div>
  <div class="form-group">
    <button class="search-item-btn">Search</button>
  </div>
   
        
        
      </div>
  
</div>
  


    </div>
    <script>
      const menu_dropdown = document.querySelector(".menu-dropdown");
      const inventory_menu = document.querySelector(".inventory-menu");

     inventory_menu.addEventListener('click', () => {
   if (menu_dropdown.style.display === 'block') {
    menu_dropdown.style.display = 'none';
  } else {
    menu_dropdown.style.display = 'block';
  }
});
    </script>
  </body>
  </html>
   