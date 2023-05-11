<?php
include 'conn.php';
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the ID and new status from the form
    $order_id = $_POST["order_id"];
    $new_status = $_POST["status"];

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update the status of the order with the given ID
    $sql = "UPDATE orders SET status='$new_status' WHERE id='$order_id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the dashboard with a success message
        header("Location: dashboard2.php?message=success");
        exit;
    } else {
        // Redirect to the dashboard with an error message
        header("Location: dashboard2.php?message=error");
        exit;
    }

    $conn->close();
}
?>