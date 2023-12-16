<?php
include "dbconnect.php";
session_start();

$username = $_SESSION['username'];

if (isset($_POST)) {
    $name = $_POST['Name'];
    $phone = $_POST['PhoneNo'];
    $dob = $_POST['DOB'];
    $address = $_POST['Address'];
    $gender = $_POST['Gender'];
    $blood = $_POST['BloodType'];

    $sql = "UPDATE `users` SET `Name`='$name',`PhoneNo`='$phone',`DOB`='$dob',`Address`='$address', `Gender`='$gender', `BloodType`='$blood' WHERE `username` = '$username'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        header("Location:../dashboard.php");
    } else {
        header("Location:../error.php?error=Something went wrong. Please try again later.");
    }
} else {
    header("Location:../error.php?error=Something went wrong. Please try again later.");

}

?>