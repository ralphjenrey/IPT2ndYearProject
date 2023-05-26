<?php
  // database configuration
  
  include 'admin.php';

// check if form is submitted

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $servername = "localhost"; // Change this to your server name
  $username = "root"; // Change this to your database username
  $password = ""; // Change this to your database password
  $dbname = "my_database"; // Change this to your database name
  
  try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    // Prepare the SQL statement to insert data into the "items" table
    $stmt = $conn->prepare("INSERT INTO items (item_name, item_variant,item_quantity, item_price, item_net_price, item_picture) VALUES (:item_name, :item_variant, :item_quantity, :item_price, :item_net_price, :item_picture)");
  
    // Bind parameters to the SQL statement
    $stmt->bindParam(':item_name', $_POST['item-name']);
     $stmt->bindParam(':item_variant', $_POST['item-variant']);
    $stmt->bindParam(':item_quantity', $_POST['item-quantity']);
    $stmt->bindParam(':item_price', $_POST['item-price']);
    $stmt->bindParam(':item_net_price', $_POST['item-net-price']);
  
    // Upload and store the item picture
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["item-picture"]["name"]);
    move_uploaded_file($_FILES["item-picture"]["tmp_name"], $target_file);
    $stmt->bindParam(':item_picture', $target_file);
  
    // Execute the SQL statement
    $stmt->execute();
     // Redirect the user to a new page to prevent form resubmission on refresh
     header("Location: inventory.php", true, 303);
     exit();
  }
  catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  
  // Close the database connection
  $conn = null;
  
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Inventory Management</title>
    <link rel="stylesheet" type="text/css" href="css/inventory.css">
  </head>
  <body>
    <div class="dashboard-container">
       <header class="bg-dark text-white text-center fs-4">
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

       <table>
      <thead>
        <tr>
          <th>Item id</th>
          <th>Item picture</th>
          <th>Item name</th>
          <th>Item quantity</th>
          <th>Item price</th>
          <th>Item net price</th>
        </tr>
      </thead>
      <tbody>
      <?php
$servername = "localhost"; // Change this to your server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "my_database"; // Change this to your database name

try {
  // Create a new PDO instance
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

  // Set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Prepare the SQL statement to select data from the "items" table
  $stmt = $conn->prepare("SELECT * FROM items");

  // Execute the SQL statement
  $stmt->execute();


    // Loop through the result set and output each row as an HTML table row
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['item_id'] . "</td>";
    echo "<td><img src='" . $row['item_picture'] . "' height='50'></td>";
    echo "<td>" . $row['item_name'] . "</td>";
    echo "<td>" . $row['item_quantity'] . "</td>";
    echo "<td>" . $row['item_price'] . "</td>";
    echo "<td>" . $row['item_net_price'] . "</td>";
    echo "</tr>";
  }
}
catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
  // Close the database connection
  $conn = null;
?>

      </tbody>
    </table>
    <div class="item-container">
      <div class="add-container">
        <form method="post" enctype="multipart/form-data">
  <label for="item-name">Item Name:</label>
  <input type="text" id="item-name" name="item-name">

  <label for="item-variant">Item Variant:</label>
<select id="item-variant" name="item-variant" required>
  <option value="">Select Brand</option>
  <option value="Apple">Apple</option>
  <option value="Xiaomi">Xiaomi</option>
  <option value="Vivo">Vivo</option>
  <option value="Oppo">Oppo</option>
  <option value="Samsung">Samsung</option>
  <option value="Lenovo">Lenovo</option>
</select>

  <label for="item-quantity">Item Quantity:</label>
  <input type="number" id="item-quantity" name="item-quantity">

  <label for="item-price">Item Price:</label>
  <input type="number" id="item-price" name="item-price">

  <label for="item-net-price">Item Net Price:</label>
  <input type="number" id="item-net-price" name="item-net-price">

  <label for="item-picture">Item Picture:</label>
  <input type="file" id="item-picture" name="item-picture" required>

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
   