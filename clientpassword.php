<?php
include 'conn.php';

if (isset($_POST["submit"])) {
    $username = $_POST["Username"];
    $password = $_POST["Password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password != $confirm_password) {
        echo "Passwords do not match";
    } else {
        $sql = "INSERT INTO cuser (`Username`, `Password`) VALUES ('$username', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>
            setTimeout(function() {
                alert('Account Created Successfully');
                window.location.href = 'dashboard2.php';
            }, 100);
            </script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>