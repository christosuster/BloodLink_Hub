<?php
include "dbconnect.php";
session_start();

$username = $_SESSION['username'];

if (isset($_POST)) {
    $name = $_POST['Name'];
    $phone = $_POST['PhoneNo'];
    $dob = $_POST['DOB'];
    $address = $_POST['Address'];

    $sql = "UPDATE `users` SET `Name`='$name',`PhoneNo`='$phone',`DOB`='$dob',`Address`='$address' WHERE `username` = '$username'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        header("Location:../profile.php?uname is wild bro");
    } else {
        header("Location:../error.php?error=Something went wrong. Please try again later.");
    }
} else {
    header("Location:../error.php?error=Something went wrong. Please try again later.");

}

?>