<?php
include 'db-conn.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Prepare the INSERT statement
        $stmt = $pdo->prepare("INSERT INTO users_cart (username, item_name, item_quantity, item_total) VALUES (?, ?, ?, ?)");

        // Iterate over the items and insert them into the table
        foreach ($_POST["item"] as $item) {
            
            $username = $_SESSION['username'];
            $item_name = $item["name"];
            $item_quantity = $item["quantity"];
            $item_total = $item["total"];
            

            // Bind parameters to the statement
            $stmt->bindParam(1, $username);
            $stmt->bindParam(2, $item_name);
            $stmt->bindParam(3, $item_quantity);
            $stmt->bindParam(4, $item_total);

            // Execute the statement
            $stmt->execute();
        }
    } catch (PDOException $e) {
        // Handle the exception here
        echo "Error: " . $e->getMessage();
    }
}
$pdo = null;
?>
