<?php
session_start();
if (!isset($_SESSION['username']))
    header("Location:../");

include "components/header.php";
include "classes/dbconnect.php";


$username = $_SESSION['username'];


$sql = "SELECT * FROM users WHERE `username` = '$username'";
$result = mysqli_query($con, $sql);
if ($result) {
    $row = mysqli_fetch_array($result);
}
?>

<div class="w-full text-center">
    <h1 class="text-3xl my-10">Update Profile</h1>
    <div class="mx-auto text-center my-5">
        <h1 class="text-sm text-white/90">Status</h1>
        <h1 class="text-lg leading-none">Unverified</h1>
    </div>

    <form action="classes/update.php" method="post" class="w-full grid grid-cols-2 gap-4">
        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="Username" class="font-bold">Username</label>
            <input disabled class="rounded shadow-inner bg-red-900 p-2" type="text" name="Username" id="Username"
                value="<?php echo $row['Username']; ?>">
        </div>
        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="Name" class="font-bold">Full Name</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="text" name="Name" id="Name"
                value="<?php echo $row['Name']; ?>">
        </div>


        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="PhoneNo" class="font-bold">Phone</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="number" name="PhoneNo" id="PhoneNo"
                value="<?php echo $row['PhoneNo']; ?>">
        </div>

        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="DOB" class="font-bold">Date of Birth</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="date" name="DOB" id="DOB"
                value="<?php echo $row['DOB']; ?>">
        </div>



        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="Address" class="font-bold">Address</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="text" name="Address" id="Address"
                value="<?php echo $row['Address']; ?>">
        </div>



        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="BloodType" class="font-bold">Blood Type</label>
            <select required id="BloodType" name="BloodType" class="rounded shadow-inner bg-red-900 p-2">
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>
        </div>
        <button class="col-span-2 button bg-red-900 px-8" type="submit">Submit</button>
    </form>
</div>



<?php
include "components/footer.php";
?>