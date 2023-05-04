<?php
session_start();
include "conn.php";

if (isset($_POST['login'])) {
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $cususer = $_POST['Username'];
    $cupass = $_POST['Password'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE `Username`=? AND `Password`=?");
    mysqli_stmt_bind_param($stmt, "ss", $Username, $Password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $count = mysqli_num_rows($result);

    $stmts = mysqli_prepare($conn, "SELECT * FROM cuser WHERE `Username`=? AND `Password`=?");
    mysqli_stmt_bind_param($stmts, "ss", $Username, $Password);
    mysqli_stmt_execute($stmts);
    $results = mysqli_stmt_get_result($stmts);

    $counts = mysqli_num_rows($results);

    if ($count > 0) {
        $_SESSION['userSession'] = $Username;
        header("Location: dashboard2.php");
        exit();
    } else {
        header("location: incorrect.html");
    }

    if ($counts > 0) {
        $_SESSION['userSession'] = $cususer;
        header("Location: dashboard3.php");
        exit();
    } else {
        header("location: incorrect.html");
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>