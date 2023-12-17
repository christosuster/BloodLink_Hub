<?php
include "dbconnect.php";
session_start();


if (isset($_POST['submit'])) {

    $uname = $_POST['ID'];
    $pass = $_POST['Pass'];
    $pass = md5($pass);

    $sql = "UPDATE users SET Pass='$pass' WHERE Username='$uname'";
    $result = mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) == 1) {
        header("Location:../hospital_admins.php");
    } else
        header("Location:../error.php?error=Password change failed");

}

?>