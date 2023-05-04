<?php
include 'conn.php';

$product_id = $_POST['id'];
$quantity = $_POST['quantity'];

// Retrieve the product's current sales and stock values
$sql = "SELECT sales, stock FROM products WHERE id = $product_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$sales = $row['sales'];
$stock = $row['stock'];

// Check if there's enough stock for the purchase
if ($quantity > $stock) {
    echo "Not enough stock available.";
} else {
    // Calculate the new sales and stock values
    $new_sales = $sales + $quantity;
    $new_stock = $stock - $quantity;

    // Update the product's sales and stock values in the database
    $sql = "UPDATE products SET sales = $new_sales, stock = $new_stock WHERE id = $product_id";
    if ($conn->query($sql) === TRUE) {
        echo "Purchase successful.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>