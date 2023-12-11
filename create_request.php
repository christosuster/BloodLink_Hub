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
    <h1 class="text-3xl my-10">Request for Donation</h1>

    <form action="classes/request.php" method="post" class="w-full grid grid-cols-2 gap-4">

        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="DonationType" class="font-bold">Donation Type</label>
            <select required id="DonationType" name="DonationType" class="rounded shadow-inner bg-red-900 p-2">
                <option value="Blood">Whole Blood</option>
                <option value="Plasma">Plasma</option>
                <option value="Platelets">Platelets</option>
                <option value="Red Cells">Red Cells</option>
            </select>
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

        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="Quantity" class="font-bold">Quantity (ml)</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="number" name="Quantity" id="Quantity"
                value="">
        </div>

        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="HospitalName" class="font-bold">Hospital Name</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="text" name="HospitalName"
                id="HospitalName" value="">
        </div>

        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="HospitalAddress" class="font-bold">Hospital Address</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="text" name="HospitalAddress"
                id="HospitalAddress" value="">
        </div>

        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="PatientName" class="font-bold">Patient Name</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="text" name="PatientName" id="PatientName"
                value="">
        </div>

        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="PatientAge" class="font-bold">Patient Age</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="number" name="PatientAge" id="PatientAge"
                value="">
        </div>


        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="NeededOn" class="font-bold">Needed On</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="date" name="NeededOn" id="NeededOn"
                value="">
        </div>

        <div class="flex flex-col text-center col-span-2 ">
            <label for="Description" class="font-bold">Brief Message</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="text" name="Description" id="Description"
                maxlength="255" value="">
        </div>




        <button class="col-span-2 button bg-red-900 px-8" type="submit">Submit</button>
    </form>
</div>

<script>
    const neededOn = document.getElementById("NeededOn");

    neededOn.addEventListener("change", function () {
        const today = new Date();
        const neededOnDate = new Date(neededOn.value);

        if (neededOnDate < today) {
            alert("Please select a date in the future.");
            neededOn.value = "";
        }
    });
</script>


<?php
include "components/footer.php";
?>