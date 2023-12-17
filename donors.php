<?php
include "components/header.php";

if ($_SESSION['role'] != 'admin')
    header("Location:index.php");


$sql = "SELECT * FROM users WHERE `VerifiedFrom` = (SELECT `HospitalID` FROM users WHERE `username` = '$username') AND `Role` = 'user' AND DATEDIFF(CURRENT_DATE(), `VerifiedOn`) < 365";
$result = mysqli_query($con, $sql);
$donors = array();
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($donors, $row);
    }
}
?>

<div class="card w-full min-h-[400px]">
    <h1 class="text-2xl text-center mb-10">Verified Donors</h1>
    <div class="overflow-x-auto">
        <table class="table-auto text-center w-full">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Blood Type</th>
                    <th>Verified On</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($donors as $donor): ?>
                    <tr>
                        <td>
                            <?php echo $donor['Username'] ?>
                        </td>
                        <td>
                            <?php echo $donor['BloodType'] ?>
                        </td>
                        <td>
                            <?php echo $donor['VerifiedOn'] ?>
                        </td>
                        <td>

                            <button class=" mx-0 button bg-red-900"
                                onclick="window.location.href='donor_details.php?id=<?php echo base64_encode($donor['Username'] . 'salt'); ?>&request='">View</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>



<?php
include "components/footer.php";
?>