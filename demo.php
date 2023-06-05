<?php
include 'session_chk.php';
include 'conn.php';

if (!isSessionActive()) {
    header("location: login.php");
}
?>
<?php

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

// Define SQL query to get all products
$product_query = "SELECT * FROM products";

// Execute the product query
$product_result = $mysqli->query($product_query);

// Define the order form
echo '<form action="process_order.php" method="post">';
echo '<label for="product_id">Select Product:</label>';
echo '<select name="product_id" id="productSelect" onchange="displayPrice()">';
// Loop through all products and add them to the select menu
while ($product_row = $product_result->fetch_assoc()) {
    echo '<option value="' . $product_row['id'] . '" data-price="' . $product_row['price'] . '">' . $product_row['title'] . '</option>';
}
echo '</select><br>';
echo '<label for="quantity">Quantity:</label>';
echo '<input type="number" name="quantity" required><br>';
echo '<label for="payment_method">Select Payment Method:</label>';
echo '<select name="payment_method">';
echo '<option value="paypal">PayPal</option>';
echo '<option value="gcash">GCash</option>';
echo '<option value="cod">Cash on Delivery</option>';
echo '</select><br>';
echo '<input type="hidden" name="user_id" value="' . $_SESSION['userSession'] . '">';
echo '<p id="priceDisplay"></p>';
echo '<input type="submit" name="submit" value="Place Order">';
echo '</form>';

// Close the database connection
$mysqli->close();

?>

<script>
    function displayPrice() {
        var selectElement = document.getElementById("productSelect");
        var priceDisplayElement = document.getElementById("priceDisplay");
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var price = selectedOption.getAttribute("data-price");
        priceDisplayElement.textContent = "Price: $" + price;
    }
</script>



<style>
    body {
        background-color: white;
        color: #35483c;
        font-family: Arial, sans-serif;
    }

    form {
        max-width: 400px;
        margin: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: #35483c;
        color: white;
        padding: 30px;
        border-radius: 5px;
    }

    label {
        margin-bottom: 10px;
    }

    input[type="text"],
    input[type="password"],
    select,
    input[type="number"] {
        padding: 5px;
        margin-bottom: 20px;
        width: 100%;
        border: none;
        border-radius: 5px;
        background-color: #f7f7f7;
    }

    input[type="submit"] {
        background-color: #35483c;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #6ebf94;
    }
</style>