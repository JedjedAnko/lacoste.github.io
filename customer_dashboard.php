<?php
include 'session_chk.php';
include 'conn.php';

// Check if the user session is active
if (!isSessionActive()) {
    header("location: login.php");
}

// Get the user ID from the session
$user_id = $_SESSION['userSession'];

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select orders of the logged-in user with product names
$sql = "SELECT o.id, p.title, o.quantity, o.total_cost, o.STATUS, o.created_at
        FROM orders o
        JOIN products p ON o.product_id = p.id
        WHERE o.user_id = '$user_id'";

// Execute the query
$result = $conn->query($sql);

// Check if there are any records in the table
if ($result->num_rows > 0) {
    // Output table header
    echo "<table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Total Cost</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["id"] . "</td>
            <td>" . $row["title"] . "</td>
            <td>" . $row["quantity"] . "</td>
            <td>" . $row["total_cost"] . "</td>
            <td>" . $row["STATUS"] . "</td>
            <td>" . $row["created_at"] . "</td>
        </tr>";
    }

    // Output table footer
    echo "</table>";
} else {
    echo "No records found";
}
?>

<style>
    body {
        background-color: #e8e8e8;
    }

    table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        background-color: #35483c;
        box-shadow: 6px 6px 16px #1e3024, -6px -6px 16px #4e6c59;
        transform: translateY(20vh);
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        color: #ffffff;
    }

    th {
        background-color: #35483c;
        text-transform: uppercase;
    }

    tr:nth-child(even) {
        background-color: #2e4436;
    }

    tr:hover {
        background-color: #3b5843;
    }

    .neumorphic-button {
        display: inline-block;
        padding: 10px 20px;
        border-radius: 10px;
        background-color: #F1F3F4;
        border: none;
        box-shadow: 6px 6px 12px #D7DBDD, -6px -6px 12px #FFFFFF;
        font-size: 16px;
        font-weight: bold;
        color: #555555;
        cursor: pointer;
        transition: box-shadow 0.3s;
        transform: translate(5vh, -45vh);
    }

    .neumorphic-button:hover {
        box-shadow: 4px 4px 8px #3b5843, -4px -4px 8px #FFFFFF;
        color: #3b5843;
    }
</style>

<!-- Go Back button -->
<button class="neumorphic-button" onclick="redirectToBuyProduct()">Go Back</button>


<script>
    function redirectToBuyProduct() {
        window.location.href = "buyproduct.php";
    }
</script>