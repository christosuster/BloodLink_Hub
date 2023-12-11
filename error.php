<?php
session_start();
include "components/header.php";

isset($_GET['error']) ? $error = $_GET['error'] : header("Location:dashboard.php");
?>

<div class="w-full flex flex-col justify-center items-center text-center">
    <h1 class="text-3xl ">
        <?php echo $_GET['error']; ?>
    </h1>

    <a class="button my-10 px-4" href="dashboard.php">Go Back</a>
</div>

<?php
include "components/footer.php";
?>