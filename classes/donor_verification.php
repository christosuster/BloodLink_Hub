<?php
include "dbconnect.php";
session_start();


if (isset($_POST['submit'])) {
    $username = $_SESSION['username'];

    $sql = "SELECT * FROM `users` WHERE `Username` = '$username'";
    $result = mysqli_query($con, $sql);
    $HospitalID = mysqli_fetch_assoc($result)['HospitalID'];

    $Uname = $_POST['Uname'];
    $BloodType = $_POST['BloodType'];
    $HBV = $_POST['HBV'];
    $HCV = $_POST['HCV'];
    $HEV = $_POST['HEV'];
    $HIV = $_POST['HIV'];
    $HTV = $_POST['HTV'];
    $Malaria = $_POST['Malaria'];
    $TB = $_POST['TB'];
    $RhFactor = $_POST['RhFactor'];
    $Pressure = $_POST['Pressure'];
    $Pulse = $_POST['Pulse'];
    $Haemoglobin = $_POST['Haemoglobin'];
    $VerificationDate = date("Y-m-d");

    $sql = "UPDATE `users` SET `BloodType` = '$BloodType', `VerifiedOn` = '$VerificationDate', `VerifiedFrom`='$HospitalID'  WHERE `Username` = '$Uname'";
    $result = mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) == 0) {
        header("Location:../error.php?error=User info error!");

    } else {
        $sql = "SELECT * FROM `bloodinformation` WHERE `Username` = '$Uname'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) == 0)
            $sql = "INSERT INTO `bloodinformation` (`Username`, `RhFactor`, `BP`, `Pulse`, `Haemoglobin`, `BloodType`) VALUES ('$Uname', '$RhFactor', '$Pressure', '$Pulse', '$Haemoglobin', '$BloodType')";
        else
            $sql = "UPDATE `bloodinformation` SET `RhFactor` = '$RhFactor', `BP` = '$Pressure', `Pulse` = '$Pulse', `Haemoglobin` = '$Haemoglobin', `BloodType`='$BloodType' WHERE `Username` = '$Uname'";

        $result = mysqli_query($con, $sql);
        if (!$result)
            header("Location:../error.php?error=Blood info error!");



        $sql = "SELECT * FROM `diseasehistory` WHERE `Username` = '$Uname'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) == 0)
            $sql = "INSERT INTO `diseasehistory` (`Username`, `HBV`, `HCV`, `HEV`, `HIV`, `HTV`, `Malaria`, `TB`) VALUES ('$Uname', '$HBV', '$HCV', '$HEV', '$HIV', '$HTV', '$Malaria', '$TB')";
        else
            $sql = "UPDATE `diseasehistory` SET `HBV` = '$HBV', `HCV` = '$HCV', `HEV` = '$HEV', `HIV` = '$HIV', `HTV` = '$HTV', `Malaria` = '$Malaria', `TB` = '$TB' WHERE `Username` = '$Uname'";

        $result = mysqli_query($con, $sql);
        if (!$result)
            header("Location:../error.php?error=Disease info error!");


        header("Location:../verify_donor.php?status=success");
    }

}

?>