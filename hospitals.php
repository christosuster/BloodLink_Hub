<?php
include "components/header.php";

if ($_SESSION['role'] != 'superuser')
    header("Location:index.php");

$sql = "SELECT * FROM hospital";
$result = mysqli_query($con, $sql);
$hospitals = array();
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($hospitals, $row);
    }
}
?>

<div>
    <div class="card">
        <h1 class="text-3xl text-center mb-10">Add Hospital</h1>

        <form action="classes/add_hospital.php" method="post" class="w-full grid grid-cols-2 gap-4">
            <div class="flex flex-col text-center md:col-span-1 col-span-2 ">
                <label for="Name" class="font-bold">Hospital Name</label>
                <input required placeholder="Care Medical Center" class="rounded shadow-inner bg-red-900 p-2"
                    type="text" name="Name" id="Name" value="">
            </div>
            <div class="flex flex-col text-center md:col-span-1 col-span-2 ">
                <label for="Address" class="font-bold">Hospital Address</label>
                <input required placeholder="123 Health Street" class="rounded shadow-inner bg-red-900 p-2" type="text"
                    name="Address" id="Address" value="">
            </div>
            <div class="flex flex-col text-center md:col-span-1 col-span-2 ">
                <label for="City" class="font-bold">City</label>
                <input required placeholder="Wellnessville" class="rounded shadow-inner bg-red-900 p-2" type="text"
                    name="City" id="City" value="">
            </div>
            <div class="flex flex-col text-center md:col-span-1 col-span-2 ">
                <label for="Division" class="font-bold">Division</label>
                <input required placeholder="Healthland" class="rounded shadow-inner bg-red-900 p-2" type="text"
                    name="Division" id="Division" value="">
            </div>
            <div class="flex flex-col text-center md:col-span-1 col-span-2 ">
                <label for="Code" class="font-bold">Code</label>
                <input required placeholder="CMC" class="rounded shadow-inner bg-red-900 p-2" type="text" name="Code"
                    id="Code" value="">
            </div>
            <div class="flex flex-col  text-center md:col-span-1 col-span-2 ">
                <label class="font-bold text-white/50">Example User</label>
                <input disabled class="rounded w-inherit text-white/50 text-center bg-red-900 p-2" type="text"
                    value="admin1@CMC">

            </div>
            <input type="submit" value="Submit" class="button col-span-2" name="submit">
        </form>
    </div>
    <div class="card mt-20 ">
        <h1 class="text-3xl text-center mb-10">All Hospitals</h1>
        <div class="bg-red-900 min-h-[300px] ">
            <table class="table-auto text-center w-full h-full overflow-y-auto border-collapse border-spacing-y-8">
                <thead>
                    <tr class="text-sm text-white/70 h-12 bg-red-950">
                        <th class="">Hospital Name</th>
                        <th class="">Hospital Address</th>
                        <th class="">Actions</th>
                    </tr>
                </thead>
                <tbody class="">
                    <?php foreach ($hospitals as $idx => $hospital): ?>
                        <tr class="<?php echo ($idx % 2 == 0) ? "bg-red-800/50" : "" ?>">
                            <td class="">
                                <?php echo $hospital['Name'] ?>
                            </td>
                            <td class="py-3">
                                <div class="flex flex-col">

                                    <p>
                                        <?php echo $hospital['Location'] ?>
                                    </p>
                                    <p>
                                        <?php echo $hospital['City'] ?>
                                    </p>
                                    <p>
                                        <?php echo $hospital['Division'] ?>
                                    </p>
                                </div>
                            </td>
                            <td class="">
                                <div>
                                    <button class=""
                                        onclick="window.location.href='edit_hospital.php?id=<?php echo base64_encode($hospital['HospitalID'] . 'salt'); ?>'"><i
                                            class="fas fa-edit  text-2xl text-yellow-500 hover:text-yellow-700 cursor-pointer"></i></button>


                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include "components/footer.php"; ?>