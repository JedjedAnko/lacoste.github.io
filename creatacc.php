<?php
include 'conn.php';

if (isset($_POST["submit"])) {
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];
    $confirm_password = $_POST["confirm_password"];

    if ($Password != $confirm_password) {
        echo "<script>
        setTimeout(function() {
            alert('Password do not match');
            window.location.href = 'login.html';
        }, 100);
        </script>";
    } else {
        $sql = "INSERT INTO cuser (`Username`, `Password`) VALUES ('$Username', '$Password')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>
            setTimeout(function() {
                alert('Account Created Successfully');
                window.location.href = 'login.php';
            }, 100);
            </script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>