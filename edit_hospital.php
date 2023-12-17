<?php
include "components/header.php";

if ($_SESSION['role'] != 'superuser')
    header("Location:index.php");

$raw_id = base64_decode($_GET['id']);
$id = preg_replace(sprintf('/%s/', 'salt'), '', $raw_id);

$sql = "SELECT * FROM hospital WHERE HospitalID = '$id'";
$result = mysqli_query($con, $sql);
if ($result && mysqli_num_rows($result) == 1) {
    $hospital = mysqli_fetch_assoc($result);
} else {
    header("Location:error.php?error=Invalid Request");
}
?>

<div class="w-full text-center">
    <h1 class="text-3xl mb-10">Update Hospital Profile</h1>
    <form action="classes/update_hospital.php" method="post" class="w-full grid grid-cols-2 gap-4">
        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="HospitalID" class="font-bold">Hospital Code</label>
            <input disabled class="rounded shadow-inner bg-red-900 p-2" type="text" name="HospitalID" id="HospitalID"
                value="<?php echo $hospital['HospitalID']; ?>">
        </div>

        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="Name" class="font-bold">Hospital Name</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="text" name="Name" id="Name"
                value="<?php echo $hospital['Name']; ?>">
        </div>


        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="Location" class="font-bold">Hospital Address</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="text" name="Location" id="Location"
                value="<?php echo $hospital['Location']; ?>">
        </div>


        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="City" class="font-bold">City</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="text" name="City" id="City"
                value="<?php echo $hospital['City']; ?>">
        </div>

        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="Division" class="font-bold">Division</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="text" name="Division" id="Division"
                value="<?php echo $hospital['Division']; ?>">
        </div>
        <input type="hidden" name="HospitalID" value="<?php echo base64_encode($hospital['HospitalID'] . 'salt'); ?>">
        <button class="col-span-2 button bg-red-900 px-8" type="submit" name="submit">Submit</button>
    </form>


</div>






<?php include "components/footer.php"; ?>