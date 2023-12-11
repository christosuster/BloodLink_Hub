<?php
include "dbconnect.php";
session_start();

$username = $_SESSION['username'];

if (isset($_POST['submit'])) {

    $id = $_POST['id'];
    $request = $_POST['request'];

    $sql = "SELECT * FROM donationrequest WHERE `DonationRequestID` = '$request' AND `CreatedBy` = '$username'";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $neededOn = $row['NeededOn'];
        $bloodType = $row['BloodType'];
        $donationType = $row['DonationType'];
        $donationAmount = $row['Quantity'];
        $hospitalName = $row['HospitalName'];

    }

    $sql = "INSERT INTO `donationhistory`(`Username`, `DonationDate`, `BloodType`, `DonationType`, `DonationAmount`,`DonationRequestID`,`HospitalName`) VALUES ('$id','$neededOn','$bloodType','$donationType','$donationAmount','$request','$hospitalName')";

    $result = mysqli_query($con, $sql);



}

?>