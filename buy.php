<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userSession'])) {
    // Redirect the user to the login page if they are not logged in
    header("Location: login.html");
    exit();
}

// Include the database connection file
include('conn.php');

// Get the product information from the database
$product_id = $_POST['id'];
$quantity = $_POST['quantity'];
$sql = "SELECT * FROM products WHERE id = '$product_id'";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

// Get the user information from the session
$user_id = $_SESSION['userSession'];

// Calculate the total cost of the order
$total_cost = $product['price'] * $quantity;

// Insert the order into the orders table
$insert_query = "INSERT INTO orders (user_id, product_id, quantity, total_cost) VALUES ('$user_id', '$product_id',
'$quantity', '$total_cost')";
mysqli_query($conn, $insert_query);

// Update the product sales and stock values in the database
$new_sales = $product['sales'] + $quantity;
$new_stock = $product['stock'] - $quantity;
$update_query = "UPDATE products SET sales = '$new_sales', stock = '$new_stock' WHERE id = '$product_id'";
mysqli_query($conn, $update_query);

// Redirect the user to the order confirmation page
header("Location: order_confirmation.php");
exit();
?>