<?php
include "dbconnect.php";
session_start();

$username = $_SESSION['username'];

if (isset($_POST)) {

    $PatientName = $_POST['PatientName'];
    $PatientAge = $_POST['PatientAge'];
    $NeededOn = $_POST['NeededOn'];
    $HospitalAddress = $_POST['HospitalAddress'];
    $HospitalName = $_POST['HospitalName'];
    $Quantity = $_POST['Quantity'];
    $BloodType = $_POST['BloodType'];
    $DonationType = $_POST['DonationType'];
    $Description = $_POST['Description'];

    $ExpiryDate = date('Y-m-d', strtotime($NeededOn . ' + 3 days'));

    $sql = "INSERT INTO `donationrequest`(`CreatedBy`,`PatientName`, `PatientAge`, `NeededOn`, `HospitalAddress`, `HospitalName`, `Quantity`, `BloodType`, `DonationType`,`CreatedOn`,`Description`,`ExpiryDate`) 
                VALUES ('$username','$PatientName','$PatientAge','$NeededOn','$HospitalAddress','$HospitalName','$Quantity','$BloodType','$DonationType',NOW(),'$Description','$ExpiryDate')";

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