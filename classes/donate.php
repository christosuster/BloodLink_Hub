<?php
include "dbconnect.php";
session_start();

$username = $_SESSION['username'];

if (isset($_POST)) {

    $id = $_POST['id'];

    $sql = "INSERT INTO `donorapplication`(`DonationRequestID`, `DonorUsername`,`ApplicationDate`) VALUES ('$id','$username',NOW())";

    $result = mysqli_query($con, $sql);

    if ($result) {
        header("Location:../browse_requests.php");
    } else {
        header("Location:../error.php?error=Something went wrong. Please try again later.");
    }


} else {
    header("Location:../error.php?error=Something went wrong. Please try again later.");

}

?>