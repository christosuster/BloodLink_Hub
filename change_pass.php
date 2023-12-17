<?php
include "components/header.php";

if ($_SESSION['role'] != 'superuser')
    header("Location:index.php");

$raw_id = base64_decode($_GET['id']);
$id = preg_replace(sprintf('/%s/', 'salt'), '', $raw_id);

$raw_code = base64_decode($_GET['code']);
$code = preg_replace(sprintf('/%s/', 'salt'), '', $raw_code);

$sql = "SELECT hospital.Name AS hospitalName,admins.Name,admins.Username,admins.Pass FROM hospital INNER JOIN (SELECT * FROM users WHERE Role = 'admin') AS admins ON hospital.HospitalID = admins.HospitalID WHERE admins.Username = '$id'";
$result = mysqli_query($con, $sql);
if ($result && mysqli_num_rows($result) == 1) {
    $admin = mysqli_fetch_assoc($result);

} else
    header("Location:error.php?error=Admin username/password error");



?>

<div class="card">
    <h1 class="text-3xl text-center mb-10">Change Password</h1>
    <form action="classes/pass_change.php" method="post" class="w-full grid grid-cols-2 gap-4">
        <div class="flex flex-col text-center md:col-span-1 col-span-2 ">
            <label for="AdminName" class="font-bold">Admin Name</label>
            <input disabled class="rounded shadow-inner bg-red-900 p-2" type="text" name="AdminName" id="AdminName"
                value="<?php echo $admin['Name'] ?>">
        </div>
        <div class="flex flex-col text-center md:col-span-1 col-span-2 ">
            <label for="AdminUsername" class="font-bold">Admin Username</label>
            <input disabled class="rounded shadow-inner bg-red-900 p-2" type="text" name="AdminUsername"
                id="AdminUsername" value="<?php echo $admin['Username'] ?>">
        </div>
        <div class="flex flex-col text-center md:col-span-1 col-span-2 ">
            <label for="AdminHospital" class="font-bold">Admin Hospital</label>
            <input disabled class="rounded shadow-inner bg-red-900 p-2" type="text" name="AdminHospital"
                id="AdminHospital" value="<?php echo $admin['hospitalName'] ?>">
        </div>
        <div class="flex flex-col text-center md:col-span-1 col-span-2 ">
            <label for="Pass" class="font-bold">New Admin Password</label>
            <input required placeholder="*******" class="rounded shadow-inner bg-red-900 p-2" type="text" name="Pass"
                id="Pass" value="">
        </div>

        <input hidden type="text" name="ID" id="ID" value="<?php echo $admin['Username'] ?>">

        <button class="col-span-2 button mt-5" type="submit" name="submit">Submit</button>
    </form>

</div>





<?php
include "components/footer.php";
?>