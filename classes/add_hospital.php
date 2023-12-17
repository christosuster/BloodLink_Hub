<?php
include "dbconnect.php";
session_start();


if (isset($_POST['submit'])) {

    $hospitalName = $_POST['Name'];
    $hospitalAddress = $_POST['Address'];
    $hospitalCity = $_POST['City'];
    $hospitalDivision = $_POST['Division'];
    $hospitalCode = $_POST['Code'];

    $sql = "SELECT * FROM `hospital` WHERE HospitalID='$hospitalCode'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        header("Location:../error.php?error=Hospital with this code already exists.");

    } else {

        $sql = "INSERT INTO `hospital`(`HospitalID`,`Name`, `Location`, `City`, `Division`) 
        VALUES ('$hospitalCode','$hospitalName','$hospitalAddress','$hospitalCity','$hospitalDivision')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            header("Location:../hospitals.php");
        } else {
            header("Location:../error.php?error=Something went wrong. Please try again later.");
        }
    }
}

?>