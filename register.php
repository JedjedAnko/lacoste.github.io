<?php
// connect to the database
$conn = mysqli_connect("localhost", "root", "", "product");

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// insert data into table
$name = $_POST['Fullname'];
$us = $_POST['username'];
$pass = $_POST['pass'];

$sql = "INSERT INTO `staff`(`Fullname`, `username`, `pass`) VALUES ('$name ','$us','$pass')";

if (mysqli_query($conn, $sql)) {
    header("location: Dashboard.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close connection
mysqli_close($conn);
