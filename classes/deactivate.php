<?php
include "dbconnect.php";
session_start();

$username = $_SESSION['username'];

if (isset($_POST['submit'])) {

    $id = $_POST['id'];

    $sql = "UPDATE `donationrequest` SET `RequestActive` = '0' WHERE `donationrequest`.`DonationRequestID` = '$id' AND `CreatedBy` = '$username'";

    $result = mysqli_query($con, $sql);

}

?>