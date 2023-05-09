<?php
// Check if the user has submitted the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the product ID and quantity from the form data
  $product_id = $_POST["product_id"];
  $quantity = $_POST["quantity"];

  // Connect to the database
  $conn = mysqli_connect("localhost", "root", "", "product");

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Fetch product data from the database
  $sql = "SELECT * FROM products WHERE id='$product_id'";
  $result = mysqli_query($conn, $sql);

  // Get the product price from the result
  $price = mysqli_fetch_assoc($result)["price"];

  // Calculate the total cost of the order
  $total_cost = $quantity * $price;

  // Insert a new order record into the database
  $sql = "INSERT INTO orders (product_id, quantity, total_cost) VALUES ('$product_id', '$quantity', '$total_cost')";
  if (mysqli_query($conn, $sql)) {
    echo "Order placed successfully! Total cost: $" . $total_cost;
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  // Close the database connection
  mysqli_close($conn);
}
