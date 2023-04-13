<?php
session_start();
include "conn.php";

$Username = $_POST['Username'];
$Password = $_POST['Password'];

$query = mysqli_query($conn, "SELECT * FROM user WHERE 'Username'='$Username'  AND 'Password' = '$Password'");
$count = mysqli_num_rows($query);

if ($count > 0) {
  $_SESSION['userSession'] = $Username;
  header("Location: dashboard2.php");
} else {
  echo "Error: Incorrect Username or Password";
}

?>