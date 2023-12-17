<?php
include "dbconnect.php";
session_start();

if (isset($_SESSION["role"]) && $_SESSION["role"] != "superuser") {
    header("Location:../index.php");
}

if (isset($_POST['submit'])) {

    $hospitalName = $_POST['Name'];
    $hospitalLocation = $_POST['Location'];
    $hospitalCity = $_POST['City'];
    $hospitalDivision = $_POST['Division'];
    $hospitalIDRaw = base64_decode($_POST['HospitalID']);
    $hospitalID = preg_replace(sprintf('/%s/', 'salt'), '', $hospitalIDRaw);

    $sql = "UPDATE `hospital` SET `Name`='$hospitalName', `Location`='$hospitalLocation', `City`='$hospitalCity', `Division`='$hospitalDivision' WHERE `HospitalID`='$hospitalID'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        header("Location:../hospitals.php");
    } else {
        header("Location:../error.php?error=Something went wrong. Please try again later.");
    }

}

?>