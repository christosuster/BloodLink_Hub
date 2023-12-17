<?php
include "dbconnect.php";
session_start();


if (isset($_POST['submit'])) {

    $name = $_POST['Name'];
    $uname = $_POST['Username'];
    $pass = $_POST['Pass'];
    $pass = md5($pass);
    $hospitalCodeRaw = base64_decode($_POST['HospitalID']);
    $hospitalCode = preg_replace(sprintf('/%s/', 'salt'), '', $hospitalCodeRaw);

    $sql = "SELECT * FROM hospital WHERE HospitalID = '$hospitalCode'";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hospitalName = $row['Name'];
    } else {
        header("Location: ../error.php?error=HospitalID not found");
    }

    $sql = "SELECT * FROM users WHERE Username = '$uname@$hospitalCode'";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO `users` (`Name`,`Username`, `Pass`, `Role`, `HospitalID`) VALUES ('$name','$uname@$hospitalCode', '$pass', 'admin', '$hospitalCode')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            header("Location: ../hospital_admins.php");
        } else {
            header("Location: ../error.php?error=Error adding admin");
        }
    } else {
        header("Location: ../error.php?error=Username already exists");
    }



}

?>