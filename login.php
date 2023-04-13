<?php
session_start();
include "conn.php";

if (isset($_POST['login'])) {
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE `Username`=? AND `Password`=?");
    mysqli_stmt_bind_param($stmt, "ss", $Username, $Password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $count = mysqli_num_rows($result);

    if ($count > 0) {
        $_SESSION['userSession'] = $Username;
        header("Location: dashboard2.php");
        exit();
    } else {
        header("location: incorrect.html");
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>