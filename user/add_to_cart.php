<?php
$servername = "localhost"; // Change this to your server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "my_database"; // Change this to your database name

// Get the JSON data from the request body
$jsonData = file_get_contents('php://input');

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Decode the JSON data into an array
    $items = json_decode($jsonData, true);

    // Prepare the SQL statement to insert or update data in the "users_cart" table
    $stmtInsert = $conn->prepare("INSERT INTO users_cart (username, item_id, item_variant, item_name, item_quantity, item_price, item_total) VALUES (:username, :itemId, :itemVariant, :itemName, :itemQuantity, :itemPrice, :itemTotal)");
    $stmtUpdate = $conn->prepare("UPDATE users_cart SET item_quantity = item_quantity + :itemQuantity, item_total = item_total + :itemTotal WHERE username = :username AND item_id = :itemId");

    session_start();
    // Iterate over each item and insert/update it into the table
    foreach ($items as $item) {
        // Get the item details
        $itemId = $item['id'];
        $itemVariant = ""; // Replace with the actual item variant if available
        $itemName = $item['name'];
        $itemQuantity = $item['quantity'];
        $itemPrice = $item['price'];

        // Calculate the item total
        $itemTotal = $itemPrice * $itemQuantity;

        // Check if the record already exists in the users_cart table
        $existingRecordStmt = $conn->prepare("SELECT COUNT(*) FROM users_cart WHERE username = :username AND item_id = :itemId");
        $existingRecordStmt->bindParam(':username', $_SESSION['username']);
        $existingRecordStmt->bindParam(':itemId', $itemId);
        $existingRecordStmt->execute();
        $existingRecordCount = $existingRecordStmt->fetchColumn();

        if ($existingRecordCount > 0) {
            // Update the existing record by adding the quantity and total
            $stmtUpdate->bindParam(':username', $_SESSION['username']);
            $stmtUpdate->bindParam(':itemId', $itemId);
            $stmtUpdate->bindParam(':itemQuantity', $itemQuantity);
            $stmtUpdate->bindParam(':itemTotal', $itemTotal);
            $stmtUpdate->execute();
        } else {
            // Insert a new record
            $stmtInsert->bindParam(':username', $_SESSION['username']);
            $stmtInsert->bindParam(':itemId', $itemId);
            $stmtInsert->bindParam(':itemVariant', $itemVariant);
            $stmtInsert->bindParam(':itemName', $itemName);
            $stmtInsert->bindParam(':itemQuantity', $itemQuantity);
            $stmtInsert->bindParam(':itemPrice', $itemPrice);
            $stmtInsert->bindParam(':itemTotal', $itemTotal);
            $stmtInsert->execute();
        }
    }

    // Output a success message
    echo "Items added to cart successfully.";

} catch (PDOException $e) {
    // Output an error message
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>
