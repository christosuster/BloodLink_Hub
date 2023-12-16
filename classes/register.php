<?php
include "dbconnect.php";
session_start();
if (isset($_POST['submit'])) {
    $uname = stripslashes($_POST['signupUsername']);
    $pass = stripslashes($_POST['signupPassword']);
    $uname = mysqli_escape_string($con, $uname);
    $pass = mysqli_escape_string($con, $pass);
    $pass = md5($pass);

    $sql = "SELECT * from `users` where `username`='$uname'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        header("Location:index.php");
    } else {
        $sql = "INSERT into `users`(`username`, `pass`) 
                VALUES ('$uname','$pass')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $_SESSION['username'] = $uname;
            header("Location:../dashboard.php");
        } else {
            echo mysqli_error($con);
        }
    }
}
?>