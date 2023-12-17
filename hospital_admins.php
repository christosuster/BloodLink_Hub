<?php
include "components/header.php";

if ($_SESSION['role'] != 'superuser')
    header("Location:index.php");

$sql = "SELECT * FROM hospital INNER JOIN (SELECT * FROM users WHERE Role = 'admin') AS admins ON hospital.HospitalID = admins.HospitalID";
$result = mysqli_query($con, $sql);
$admins = array();
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($admins, $row);
    }
}

$sql = "SELECT * FROM hospital";
$result = mysqli_query($con, $sql);
$hospitals = array();
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($hospitals, $row);
    }
}


?>

<div class="card">
    <h1 class="text-3xl text-center mb-10">Create Hospital Admin</h1>
    <form action="classes/add_admin.php" method="post" class="w-full grid grid-cols-2 gap-4">
        <div class="flex flex-col text-center  col-span-2 ">
            <label for="HospitalID" class="font-bold">Hospital Name</label>
            <select name="HospitalID" id="HospitalID" class="rounded shadow-inner bg-red-900 p-2">
                <?php
                foreach ($hospitals as $hospital) {
                    echo "<option value='" . base64_encode($hospital['HospitalID'] . "salt") . "'>" . $hospital['Name'] . " (" . $hospital['HospitalID'] . ")" . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="flex flex-col text-center md:col-span-1 col-span-2 ">
            <label for="Name" class="font-bold">Admin Name</label>
            <input required placeholder="John Doe" class="rounded shadow-inner bg-red-900 p-2" type="text" name="Name"
                id="Name" value="">
        </div>
        <div class="flex flex-col text-center md:col-span-1 col-span-2 ">
            <label for="Username" class="font-bold">Admin Username</label>
            <input required placeholder="John Doe" class="rounded shadow-inner bg-red-900 p-2" type="text"
                name="Username" id="Username" value="">
        </div>
        <div class="flex flex-col text-center md:col-span-1 col-span-2 ">
            <label for="Pass" class="font-bold">Admin Password</label>
            <input required placeholder="*******" class="rounded shadow-inner bg-red-900 p-2" type="text" name="Pass"
                id="Pass" value="">
        </div>
        <button class="col-span-2 button" type="submit" name="submit">Submit</button>

    </form>

</div>

<div class="card mt-20 ">
    <h1 class="text-3xl text-center mb-10">All Admins</h1>
    <div class="bg-red-900 min-h-[300px] ">
        <table class="table-auto text-center w-full h-full overflow-y-auto border-collapse border-spacing-y-8">
            <thead>
                <tr class="text-sm text-white/70 h-12 bg-red-950">
                    <th class="">Name</th>
                    <th class="">Username</th>
                    <th class="">Hospital</th>
                    <th class="">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($admins as $idx => $admin):
                    ?>

                    <tr class="<?php echo ($idx % 2 == 0) ? "bg-red-800/50" : "" ?>">
                        <td class="">
                            <?php echo $admin['Name'] ?>
                        </td>
                        <td class="">
                            <?php echo $admin['Username'] ?>
                        </td>
                        <td class="">
                            <?php echo $admin['HospitalID'] ?>
                        </td>
                        <td class="py-3">
                            <button>
                                <i class="fas fa-edit text-2xl text-yellow-500 hover:text-yellow-700"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
        </table>
    </div>
</div>

<script>

    const usernameElement = document.getElementById('Username');

    usernameElement.addEventListener('input', (e) => {
        const username = e.target.value;
        var regex = /^[a-zA-Z0-9]+$/;

        if (!regex.test(username)) {
            alert('Username can only contain alphabets and numbers.');
            e.target.value = '';
        }
    });



</script>




<?php include "components/footer.php"; ?>