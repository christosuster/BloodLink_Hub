<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/components.css">

    <title>Blood Bank</title>
</head>

<body class="bg-red-800 text-white">
    <!-- <nav class="navbar navbar-inverse">
        <div class="container-fluid container">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="request.php">Request Blood</a></li>
                        <li><a href="search.php">Active Donors</a></li>
                        <li><a href="check_requests.php">Check Requests</a></li>
                        <li><a href="profile.php?id=<?php echo base64_encode($_SESSION['login_user']); ?>">Update
                                Profile</a></li>
                        <li><a href="about.php">Our Mission</a></li>
                    </ul>
                </li>
            </ul>
            <span class="navbar-brand logo"><a href="about.php">Blood Bank</a></span>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (isset($_SESSION['login_user'])) {
                    $name = $_SESSION['login_user'];
                    $encode = base64_encode($name);
                    echo "<li><a href=\"profile.php?id=$encode\"> Welcome, $name </a></li>";
                    echo "<li><a href=\"classes/logout.php\">Logout</a></li>";
                } else {
                    $str = "<li>
                                    <a href=\"index.php\">
                                        <span class=\"glyphicon glyphicon-user\"></span> Sign Up
                                    </a>
                                </li>
                                <li>
                                <a href=\"index.php\">
                                        <span class=\"glyphicon glyphicon-log-in\"></span> Login
                                    </a>
                                </li>";

                    echo $str;
                }
                ?>
            </ul>
        </div>
    </nav> -->
    <header class="w-full bg-red-900">
        <nav class="flex px-3 w-full md:w-[85vw] mx-auto items-center justify-between flex-wrap py-6">
            <div class="flex items-center flex-shrink-0 text-white mr-6">
                <a href="./dashboard.php" class="font-semibold text-xl tracking-tight">BloodLink Hub</a>
            </div>

            <button id="nav-toggle"
                class="flex block lg:hidden items-center px-3 py-2 border rounded text-white-200 hover:text-white hover:border-white">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <title>Menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v15z" />
                </svg>
            </button>

            <div class="w-full hidden flex-grow lg:flex lg:items-center lg:w-auto" id="nav-content">
                <div class="text-sm lg:flex-grow lg:flex justify-end items-center">
                    <a href="profile.php"
                        class="block mt-4 lg:inline-block lg:mt-0 text-white-200 hover:text-white mr-4">
                        Edit Profile
                    </a>
                    <a href="create_request.php"
                        class="block mt-4 lg:inline-block lg:mt-0 text-white-200 hover:text-white mr-4">
                        Create Request
                    </a>
                    <a href="browse_requests.php"
                        class="block mt-4 lg:inline-block lg:mt-0 text-white-200 hover:text-white mr-4">
                        Browse Requests
                    </a>

                    <a href="classes/logout.php"
                        class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-red-500 hover:bg-white mt-4 lg:mt-0">Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <div class="min-h-screen w-full md:w-[85vw] mx-auto p-10">