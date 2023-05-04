<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userSession'])) {
    // Redirect the user to the login page if they are not logged in
    header("Location: login.html");
    exit();
}

// Include the database connection file
include('conn.php');

// Get the user's cart from the database
$user_id = $_SESSION['userSession'];
$sql = "SELECT * FROM cart WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);

// Display the cart contents
echo '<h1>My Cart</h1>';
echo '<table>';
echo '<tr><th>Product</th><th>Price</th><th>Quantity</th><th>Total</th></tr>';
$total = 0;
while ($row = mysqli_fetch_assoc($result)) {
    // Get the product information from the database
    $product_id = $row['product_id'];
    $sql = "SELECT * FROM products WHERE id = '$product_id'";
    $product_result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($product_result);

    // Calculate the total for this item
    $quantity = $row['quantity'];
    $item_total = $product['price'] * $quantity;

    // Display the item in the cart
    echo '<tr>';
    echo '<td>' . $product['name'] . '</td>';
    echo '<td>$' . number_format($product['price'], 2) . '</td>';
    echo '<td>' . $quantity . '</td>';
    echo '<td>$' . number_format($item_total, 2) . '</td>';
    echo '</tr>';

    // Add the item total to the cart total
    $total += $item_total;
}

// Display the cart total
echo '<tr><td colspan="3">Total:</td><td>$' . number_format($total, 2) . '</td></tr>';
echo '</table>';
?>