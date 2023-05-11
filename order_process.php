<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "orders");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the form data
$product = $_POST['product'];
$quantity = $_POST['quantity'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// Insert the order into the database
$sql = "INSERT INTO orders (product, quantity, name, email, phone, order_date, order_status) VALUES ('$product', '$quantity', '$name', '$email', '$phone', now(), 'Pending')";
if (mysqli_query($conn, $sql)) {
    echo "Order placed successfully!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>