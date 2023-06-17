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
    $stmt = $conn->prepare("INSERT INTO items (item_name, item_variant, item_quantity, item_price, item_net_price, item_picture) VALUES (:item_name, :item_variant, :item_quantity, :item_price, :item_net_price, :item_picture)");

$itemName = htmlspecialchars($_POST['item-name']);
$itemVariant = htmlspecialchars($_POST['item-variant']);
$itemQuantity = $_POST['item-quantity'];
$itemPrice = $_POST['item-price'];
$itemNetPrice = $_POST['item-net-price'];
$stmt->bindParam(':item_name', $itemName);
$stmt->bindParam(':item_variant', $itemVariant);
$stmt->bindParam(':item_quantity', $itemQuantity);
$stmt->bindParam(':item_price', $itemPrice);
$stmt->bindParam(':item_net_price', $itemNetPrice);
  
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
  } catch(PDOException $e) {
      // Log the error to a file
  error_log("Database Error: " . $e->getMessage(), 0);

  // Display a user-friendly error message
  echo "An error occurred. Please try again later.";
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
  <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
      Menu
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addItemModal">Add Item</button></li>
       <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#searchModal">Search</button></li>
    </ul>
  </div>
  Inventory Management
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
      <tbody id="table-body">
         <p id="no-results-message" style="display: none; text-align: center;">No items found</p>
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
             echo "<tr class='table-row'>";
  echo "<td class='item-id'>" . $row['item_id'] . "</td>";
  echo "<td class='item-picture'><img src='" . $row['item_picture'] . "' height='50'></td>";
  echo "<td class='item-name'>" . $row['item_name'] . "</td>";
  echo "<td class='item-quantity'>" . $row['item_quantity'] . "</td>";
  echo "<td class='item-price'>" . $row['item_price'] . "</td>";
  echo "<td class='item-net-price'>" . $row['item_net_price'] . "</td>";
  echo "</tr>";
          }
        } catch(PDOException $e) {
           // Log the error to a file
  error_log("Database Error: " . $e->getMessage(), 0);

  // Display a user-friendly error message
  echo "An error occurred. Please try again later.";
        }
        
        // Close the database connection
        $conn = null;
        ?>
      </tbody>
    </table>
  <!-- Add Item Modal -->
  <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addItemModalLabel">Add Item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="item-name" class="form-label">Item Name:</label>
              <input type="text" id="item-name" name="item-name" class="form-control">
            </div>

            <div class="mb-3">
              <label for="item-variant" class="form-label">Item Variant:</label>
              <select id="item-variant" name="item-variant" class="form-select" required>
                <option value="">Select Brand</option>
                <option value="Apple">Apple</option>
                <option value="Xiaomi">Xiaomi</option>
                <option value="Vivo">Vivo</option>
                <option value="Oppo">Oppo</option>
                <option value="Samsung">Samsung</option>
                <option value="Lenovo">Lenovo</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="item-quantity" class="form-label">Item Quantity:</label>
              <input type="number" id="item-quantity" name="item-quantity" class="form-control">
            </div>

            <div class="mb-3">
              <label for="item-price" class="form-label">Item Price:</label>
              <input type="number" id="item-price" name="item-price" class="form-control">
            </div>

            <div class="mb-3">
              <label for="item-net-price" class="form-label">Item Net Price:</label>
              <input type="number" id="item-net-price" name="item-net-price" class="form-control">
            </div>

            <div class="mb-3">
              <label for="item-picture" class="form-label">Item Picture:</label>
              <input type="file" id="item-picture" name="item-picture" class="form-control" required>
            </div>

            <input type="submit" name="submit" class="btn btn-primary" value="Add Item">
          </form>
        </div>
      </div>
    </div>
  </div>

 

      <!-- Search Modal -->
  <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="searchModalLabel">Search</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
              <label for="search-name" class="form-label">Item Name:</label>
              <input type="text" id="search-name" name="search-name" class="form-control">
            </div>

            <div class="mb-3">
              <label for="search-variant" class="form-label">Item Variant:</label>
              <select id="search-variant" name="search-variant" class="form-select">
                <option value="">All Brands</option>
                <option value="Apple">Apple</option>
                <option value="Xiaomi">Xiaomi</option>
                <option value="Vivo">Vivo</option>
                <option value="Oppo">Oppo</option>
                <option value="Samsung">Samsung</option>
                <option value="Lenovo">Lenovo</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="search-min-price" class="form-label">Minimum Price:</label>
              <input type="number" id="search-min-price" name="search-min-price" class="form-control">
            </div>

            <div class="mb-3">
              <label for="search-max-price" class="form-label">Maximum Price:</label>
              <input type="number" id="search-max-price" name="search-max-price" class="form-control">
            </div>

            <button type="button" name="submit" class="btn btn-primary">Search</button>
        </div>
      </div>
    </div>
  </div>

  </div>
  <!-- Place this script at the end of your HTML body -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('.btn-primary').on('click', function() {
    // Get the search input values
    var searchName = $('#search-name').val().toLowerCase();
    var searchVariant = $('#search-variant').val().toLowerCase();
    var searchMinPrice = parseFloat($('#search-min-price').val());
    var searchMaxPrice = parseFloat($('#search-max-price').val());

    // Loop through each table row and hide/show based on search criteria
    $('.table-row').each(function() {
      var itemName = $(this).find('.item-name').text().toLowerCase();
      var itemVariant = $(this).find('.item-variant').text().toLowerCase();
      var itemPrice = parseFloat($(this).find('.item-price').text());

      var matchesSearch =
        (searchName === '' || itemName.indexOf(searchName) !== -1) &&
        (searchVariant === '' || itemVariant.indexOf(searchVariant) !== -1) &&
        (isNaN(searchMinPrice) || itemPrice >= searchMinPrice) &&
        (isNaN(searchMaxPrice) || itemPrice <= searchMaxPrice);

      // Show/hide the table row based on search criteria
      $(this).toggle(matchesSearch);
    });

    // Show a message if no results are found
    var visibleRows = $('.table-row:visible').length;
    if (visibleRows === 0) {
      $('#no-results-message').show();
    } else {
      $('#no-results-message').hide();
    }
  });
});
</script>
  </body>
  </html>
   