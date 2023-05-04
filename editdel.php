<?php
include 'conn.php';

// Delete record if ID is set in the URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM products WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                            setTimeout(function() {
                                alert('Product Deleted Successfully');
                                window.location.href = 'dashboard2.php';
                            }, 100);
                        </script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>