<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['role']))
    header("Location:index.php");

include "classes/dbconnect.php";

$username = $_SESSION['username'];
$role = $_SESSION['role'];

$sql = "SELECT * FROM users WHERE username='$username' AND role='$role'";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) == 1) {
    $loggedInUser = mysqli_fetch_assoc($result);

} else
    header("Location:index.php");



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;500;600;700&family=Lato:wght@300;400;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/components.css">

    <title>BloodLink Hub</title>
</head>

<body class="bg-red-800 text-white">


    <header class="w-full bg-red-900">
        <?php if ($role == 'user'): ?>
            <nav class="flex px-3 py-3 lg:py-0 w-full md:w-[85vw] mx-auto items-center justify-between flex-wrap">
                <div class="flex items-center flex-shrink-0 text-white mr-6">
                    <a href="./dashboard.php" class="font-semibold text-2xl tracking-tight">BloodLink Hub</a>
                </div>

                <button id="nav-toggle" class="flex block lg:hidden items-center p-3 rounded-full">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <div class="w-full hidden flex-grow lg:flex lg:items-center lg:w-auto" id="nav-content">
                    <div class="text-sm lg:flex-grow lg:flex justify-end items-center">
                        <a href="profile.php" class="block mt-4 lg:inline-block hover:bg-red-400/10 lg:mt-0 px-3 py-6 border-b-2 border-transparent <?php if ($_SERVER['PHP_SELF'] == "/BloodLink_Hub/profile.php")
                            echo "active" ?>">
                                Edit Profile
                            </a>
                            <a href="create_request.php" class="block px-3 lg:inline-block lg:mt-0 py-6 border-b-2 border-transparent hover:bg-red-400/10 <?php if ($_SERVER['PHP_SELF'] == "/BloodLink_Hub/create_request.php")
                            echo "active" ?>">
                                Create Request
                            </a>
                            <a href="browse_requests.php" class="block px-3 lg:inline-block lg:mt-0  hover:bg-red-400/10 py-6 border-b-2 border-transparent <?php if ($_SERVER['PHP_SELF'] == "/BloodLink_Hub/browse_requests.php")
                            echo "active" ?>">
                                Browse Requests
                            </a>

                            <a href="classes/logout.php"
                                class="inline-block bg-white/10 text-sm px-4 py-3 hover:bg-red-500/50 leading-none rounded  mt-4 lg:ml-8 transition ease-in-out duration-400 lg:mt-0"><i
                                    class="fa-solid fa-arrow-right-from-bracket mr-2"></i>Logout</a>
                        </div>
                    </div>
                </nav>
        <?php elseif ($role == 'superuser'): ?>
            <nav class="flex px-3 py-3 lg:py-0 w-full md:w-[85vw] mx-auto items-center justify-between flex-wrap">
                <div class="flex items-center flex-shrink-0 text-white mr-6">
                    <a href="./dashboard.php" class="font-semibold text-2xl tracking-tight">BloodLink Hub</a>
                </div>

                <button id="nav-toggle" class="flex block lg:hidden items-center p-3 rounded-full">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <div class="w-full hidden flex-grow lg:flex lg:items-center lg:w-auto" id="nav-content">
                    <div class="text-sm lg:flex-grow lg:flex justify-end items-center">
                        <a href="profile.php" class="block mt-4 lg:inline-block hover:bg-red-400/10 lg:mt-0 px-3 py-6 border-b-2 border-transparent <?php if ($_SERVER['PHP_SELF'] == "/BloodLink_Hub/profile.php")
                            echo "active" ?>">
                                Profile
                            </a>
                            <a href="hospitals.php" class="block mt-4 lg:inline-block hover:bg-red-400/10 lg:mt-0 px-3 py-6 border-b-2 border-transparent <?php if ($_SERVER['PHP_SELF'] == "/BloodLink_Hub/hospitals.php")
                            echo "active" ?>">
                                Hospitals
                            </a>
                            <a href="hospital_admins.php" class="block px-3 lg:inline-block lg:mt-0 py-6 border-b-2 border-transparent hover:bg-red-400/10 <?php if ($_SERVER['PHP_SELF'] == "/BloodLink_Hub/hospital_admins.php")
                            echo "active" ?>">
                                Admins
                            </a>


                            <a href="classes/logout.php"
                                class="inline-block bg-white/10 text-sm px-4 py-3 hover:bg-red-500/50 leading-none rounded  mt-4 lg:ml-8 transition ease-in-out duration-400 lg:mt-0"><i
                                    class="fa-solid fa-arrow-right-from-bracket mr-2"></i>Logout</a>
                        </div>
                    </div>
                </nav>
        <?php elseif ($role == 'admin'): ?>
            <nav class="flex px-3 py-3 lg:py-0 w-full md:w-[85vw] mx-auto items-center justify-between flex-wrap">
                <div class="flex items-center flex-shrink-0 text-white mr-6">
                    <a href="./profile.php" class="font-semibold text-2xl tracking-tight">BloodLink Hub</a>
                </div>

                <button id="nav-toggle" class="flex block lg:hidden items-center p-3 rounded-full">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <div class="w-full hidden flex-grow lg:flex lg:items-center lg:w-auto" id="nav-content">
                    <div class="text-sm lg:flex-grow lg:flex justify-end items-center">
                        <a href="profile.php" class="block mt-4 lg:inline-block hover:bg-red-400/10 lg:mt-0 px-3 py-6 border-b-2 border-transparent <?php if ($_SERVER['PHP_SELF'] == "/BloodLink_Hub/profile.php")
                            echo "active" ?>">
                                Profile
                            </a>
                            <a href="verify_donor.php" class="block mt-4 lg:inline-block hover:bg-red-400/10 lg:mt-0 px-3 py-6 border-b-2 border-transparent <?php if ($_SERVER['PHP_SELF'] == "/BloodLink_Hub/verify_donor.php")
                            echo "active" ?>">
                                Verify Donor
                            </a>
                            <a href="donors.php" class="block mt-4 lg:inline-block hover:bg-red-400/10 lg:mt-0 px-3 py-6 border-b-2 border-transparent <?php if ($_SERVER['PHP_SELF'] == "/BloodLink_Hub/donors.php")
                            echo "active" ?>">
                                All Donors
                            </a>



                            <a href="classes/logout.php"
                                class="inline-block bg-white/10 text-sm px-4 py-3 hover:bg-red-500/50 leading-none rounded  mt-4 lg:ml-8 transition ease-in-out duration-400 lg:mt-0"><i
                                    class="fa-solid fa-arrow-right-from-bracket mr-2"></i>Logout</a>
                        </div>
                    </div>
                </nav>
        <?php endif; ?>
    </header>

    <div class="min-h-screen w-full md:w-[85vw] mx-auto p-10">