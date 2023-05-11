<?php
include 'session_chk.php';

if (!isSessionActive()) {
    header("location: login.php");
}

// Define database connection constants
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'product');

// Connect to the database
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection error
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error);
}

// Get the product ID and quantity from the form submission
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
$user_id = $_POST['user_id'];

// Query the database to get the price of the product and the current stock
$product_query = "SELECT price, stock FROM products WHERE id = $product_id";
$product_result = $mysqli->query($product_query);
$product_row = $product_result->fetch_assoc();
$price = $product_row['price'];
$current_stock = $product_row['stock'];

// Calculate the total cost of the order
$total_cost = $quantity * $price;

// Check if there's enough stock for the order
if ($current_stock >= $quantity) {
    // Insert the order into the database
    $insert_query = "INSERT INTO orders (product_id, user_id, quantity, total_cost, status) 
                     VALUES ($product_id, '$user_id', $quantity, $total_cost, 'pending')";
    if ($mysqli->query($insert_query) === TRUE) {
        echo "<script>
        setTimeout(function() {
            alert('Order Placed Successfully');
            window.location.href = 'buyproduct.php';
        }, 100);
    </script>";
        // Update the product stock and sales
        $update_query = "UPDATE products SET stock = stock - $quantity, sales = sales + $quantity WHERE id = $product_id";
        if ($mysqli->query($update_query) === FALSE) {
            echo "Error updating product stock and sales: " . $mysqli->error;
        }
    } else {
        echo "Error placing order: " . $mysqli->error;
    }
} else {
    echo "Not enough stock for the order!";
}

// Close the database connection
$mysqli->close();
?>