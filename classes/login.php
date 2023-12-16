<?php
include "dbconnect.php";
session_start();
if (isset($_POST['submit'])) {
    $uname = stripslashes($_POST['loginUsername']);
    $pass = stripslashes($_POST['loginPassword']);
    $uname = mysqli_escape_string($con, $uname);
    $pass = mysqli_escape_string($con, $pass);
    $pass = md5($pass);

    $sql = "SELECT * FROM users WHERE Username = '$uname' AND Pass = '$pass'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $uname;
        $_SESSION['role'] = mysqli_fetch_array($result)['Role'];
        header("Location:../dashboard.php");
    } else {
        header("Location:../error.php");
    }
} else {
    header("Location:../error.php");
}
?>