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

// Get the submitted form data
$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
$username = isset($_POST['username']) ? $_POST['username'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

// Check if any of the required form fields is missing
if (!$product_id || !$quantity || !$username || !$password) {
    die('Missing form fields');
}

// Define SQL query to get the user with the submitted username and password
$user_query = "SELECT * FROM cuser WHERE Username = '$username' AND Password = '$password'";

// Execute the user query
$user_result = $mysqli->query($user_query);

// Check if the user exists
if ($user_result->num_rows == 0) {
    die('Invalid username or password');
}

// Get the user ID
$user_row = $user_result->fetch_assoc();
$user_id = $user_row['id'];

// Define SQL query to get the selected product
$product_query = "SELECT * FROM products WHERE id = '$product_id'";

// Execute the product query
$product_result = $mysqli->query($product_query);

// Check if the product exists
if ($product_result->num_rows == 0) {
    die('Invalid product selection');
}

// Get the product details
$product_row = $product_result->fetch_assoc();
$product_title = $product_row['title'];
$product_price = $product_row['price'];
$product_stock = $product_row['stock'];

// Check if there is enough stock
if ($product_stock < $quantity) {
    die('Not enough stock');
}

// Calculate the total cost
$total_cost = $product_price * $quantity;

// Generate a new order ID
do {
    $order_id = uniqid();
    $check_query = "SELECT id FROM orders WHERE id = '$order_id'";
    $check_result = $mysqli->query($check_query);
} while ($check_result->num_rows > 0);

// Insert the order details into the orders table
$insert_query = "INSERT INTO orders (id, product_id, user_id, quantity, total_cost) VALUES ('$order_id', '$product_id', '$user_id', '$quantity', '$total_cost')";
if (!$mysqli->query($insert_query)) {
    die('Error inserting order: ' . $mysqli->error);
}


// Update the product stock
$update_query = "UPDATE products SET stock = stock - $quantity, sales = sales + $quantity WHERE id = '$product_id'";
if (!$mysqli->query($update_query)) {
    die('Error updating product: ' . $mysqli->error);
}


$order_query = "SELECT orders.id, products.title, orders.quantity, orders.total_cost, cuser.Username
FROM orders
JOIN products ON products.id = orders.product_id
JOIN cuser ON cuser.id = orders.user_id
WHERE orders.id = '$order_id'";
$order_result = $mysqli->query($order_query);
$order_row = $order_result->fetch_assoc();

// Display the order details in a table
echo '<h2>Order Details</h2>';
echo '<table>';
echo '<tr>
        <th>Order ID</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Total Cost</th>
        <th>User</th>
    </tr>';
echo '<tr>
        <td>' . $order_row['id'] . '</td>
        <td>' . $order_row['title'] . '</td>
        <td>' . $order_row['quantity'] . '</td>
        <td>' . $order_row['total_cost'] . '</td>
        <td>' . $order_row['Username'] . '</td>
    </tr>';
echo '</table>';

$mysqli->close();

// Display a success message
echo 'Order placed successfully with ID ' . $order_id . '!';

echo "<script>
setTimeout(function() {
    alert('Product Purchase Sucessfully');
    window.location.href = 'buyproduct.php';
}, 2000);
</script>";

?>
<style>
    .wrapper {
        position: relative;
        width: 960px;
        padding: 10px;

    }

    section {
        position: absolute;
        display: none;
        top: 10px;
        right: 0;
        width: 1140px;
        min-height: 550px;
        transform: translate(-1vh, -1vh);
        overflow-y: scroll;
    }

    section:first-of-type {
        display: block;
    }

    nav {
        float: left;
        width: 200px;
    }


    .products-area-wrapper {
        width: 100%;
        max-height: 580px;
        padding: 0 4px;
        overflow-y: scroll;
    }

    a {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 10px 16px;
        color: var(--sidebar-link);
        text-decoration: none;
        font-size: 14px;
        line-height: 24px;
    }


    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #35483c;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }
</style>