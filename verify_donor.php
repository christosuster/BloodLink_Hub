<?php
include "components/header.php";

if ($_SESSION['role'] != 'admin')
    header("Location:index.php");


?>

<div class="w-full text-center">
    <h1 class="text-3xl my-10">Verify Donor's Profile</h1>

    <form action="classes/donor_verification.php" method="post" class="w-full grid grid-cols-2 gap-4">

        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="Uname" class="font-bold">Donor's Username</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="text" name="Uname" id="Uname" value="">
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
            <label for="RhFactor" class="font-bold">Rh Factor</label>
            <select required id="RhFactor" name="RhFactor" class="rounded shadow-inner bg-red-900 p-2">
                <option value="Positive">Positive</option>
                <option value="Negative">Negative</option>
            </select>
        </div>


        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="Haemoglobin" class="font-bold">Haemoglobin (g/dl)</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="number" name="Haemoglobin"
                id="Haemoglobin" value="">
        </div>

        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="Pulse" class="font-bold">Pulse (bpm)</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="number" name="Pulse" id="Pulse" value="">
        </div>

        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="Pressure" class="font-bold">Blood Pressure (mmHg)</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="text" name="Pressure" id="Pressure"
                value="">
        </div>

        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="HBV" class="font-bold">Hepatitis B Virus</label>
            <select required id="HBV" name="HBV" class="rounded shadow-inner bg-red-900 p-2">
                <option value="1">Positive</option>
                <option value="0">Negative</option>
            </select>
        </div>

        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="HCV" class="font-bold">Hepatitis C Virus</label>
            <select required id="HCV" name="HCV" class="rounded shadow-inner bg-red-900 p-2">
                <option value="1">Positive</option>
                <option value="0">Negative</option>
            </select>
        </div>
        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="HEV" class="font-bold">Hepatitis E Virus</label>
            <select required id="HEV" name="HEV" class="rounded shadow-inner bg-red-900 p-2">
                <option value="1">Positive</option>
                <option value="0">Negative</option>
            </select>
        </div>
        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="HIV" class="font-bold">HIV</label>
            <select required id="HIV" name="HIV" class="rounded shadow-inner bg-red-900 p-2">
                <option value="1">Positive</option>
                <option value="0">Negative</option>
            </select>
        </div>
        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="HTV" class="font-bold">Human T-lymphotropic Virus</label>
            <select required id="HTV" name="HTV" class="rounded shadow-inner bg-red-900 p-2">
                <option value="1">Positive</option>
                <option value="0">Negative</option>
            </select>
        </div>
        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="Malaria" class="font-bold">Malaria</label>
            <select required id="Malaria" name="Malaria" class="rounded shadow-inner bg-red-900 p-2">
                <option value="1">Positive</option>
                <option value="0">Negative</option>
            </select>
        </div>
        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="TB" class="font-bold">Active Tuberculosis</label>
            <select required id="TB" name="TB" class="rounded shadow-inner bg-red-900 p-2">
                <option value="1">Positive</option>
                <option value="0">Negative</option>
            </select>
        </div>


        <button class="col-span-2 button bg-red-900 px-8" type="submit" name="submit">Submit</button>
    </form>
</div>



<?php
include "components/footer.php";
?>