<?php
include "dbconnect.php";
session_start();

$username = $_SESSION['username'];

if (isset($_POST['submit'])) {

    $id = $_POST['id'];

    $sql = "DELETE FROM `donorapplication` WHERE `DonorApplicationID` = '$id' AND `DonorUsername` = '$username'";
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