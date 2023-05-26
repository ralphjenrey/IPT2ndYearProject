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
    $sql = "INSERT INTO items (item_name, item_quantity, item_price, item_net_price, item_picture) 
            VALUES ('$item_name', '$item_quantity', '$item_price', '$item_net_price', '$item_picture')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// close database connection
mysqli_close($conn);
?>
