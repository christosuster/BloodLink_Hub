<?php
include "components/header.php";

if ($_SESSION['role'] != 'user' && $_SESSION['role'] != 'admin')
    header("Location:index.php");

$raw_id = base64_decode($_GET['id']);
$id = preg_replace(sprintf('/%s/', 'salt'), '', $raw_id);

$raw_request = base64_decode($_GET['request']);
$request = preg_replace(sprintf('/%s/', 'salt'), '', $raw_request);



$sql = "SELECT * FROM users WHERE Username = '$id'";
$result = mysqli_query($con, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_array($result);
}

$sql = "SELECT * FROM bloodinformation WHERE Username = '$id'";
$result = mysqli_query($con, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $blood = mysqli_fetch_array($result);
} else {
    $blood = array(
        'RhFactor' => 'N/A',
        'Haemoglobin' => 'N/A',
        'Pulse' => 'N/A',
        'BP' => 'N/A',
    );

}

$sql = "SELECT * FROM diseasehistory WHERE Username = '$id'";
$result = mysqli_query($con, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $disease = mysqli_fetch_array($result);
} else {
    $disease = array(
        'HBV' => 'N/A',
        'HIV' => 'N/A',
        'HCV' => 'N/A',
        'HEV' => 'N/A',
        'HTV' => 'N/A',
        'Malaria' => 'N/A',
        'TB' => 'N/A'
    );
}

$sql = "SELECT * FROM donationhistory WHERE Username = '$id' AND DonationRequestID = '$request'";
$result = mysqli_query($con, $sql);
if ($result && mysqli_num_rows($result) == 1) {
    $alreadyConfirmed = true;
} else {
    $alreadyConfirmed = false;
}

$verifiedOn = new DateTime($user['VerifiedOn']);
$verifiedTill = $verifiedOn->add(new DateInterval('P1Y'));

$sql = "SELECT * FROM donationhistory WHERE `Username` = '$id'";
$result = mysqli_query($con, $sql);
$donationHistory = array();
if ($result && mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        array_push($donationHistory, $row);
    }
}

?>

<div class=" grid grid-cols-3 gap-10">
    <div class="lg:col-span-1 col-span-3 flex flex-col justify-center items-center card relative">
        <div>
            <img class="rounded-full w-[200px]" src="https://www.w3schools.com/howto/img_avatar.png" alt="">
        </div>
        <div class="text-center my-3">
            <div class="my-4">
                <h1 class="text-xs  text-white/70 leading-none">NAME</h1>
                <h1 class="text-xl leading-none">
                    <?php echo $user['Name'] ?>
                </h1>
            </div>
            <div class="my-4">
                <h1 class="text-xs  text-white/70 leading-none">GENDER</h1>
                <h1 class="text-xl leading-none">
                    <?php echo $user['Gender'] ?>
                </h1>
            </div>
            <div class="my-4">
                <h1 class="text-xs  text-white/70 leading-none">PHONE</h1>
                <h1 class="text-xl leading-none">
                    <?php echo $user['PhoneNo'] ?>
                </h1>
            </div>
            <div class="my-4">
                <h1 class="text-xs  text-white/70 leading-none">LOCATION</h1>
                <h1 class="text-xl leading-none">
                    <?php echo $user['Address'] ?>
                </h1>
            </div>
            <div class="my-4">
                <h1 class="text-xs  text-white/70 leading-none">DONATIONS MADE</h1>
                <h1 class="text-xl leading-none">
                    <?php echo count($donationHistory) ?>
                </h1>
            </div>
        </div>

        <?php if ($user['VerifiedOn'] != NULL && $verifiedTill > new DateTime()): ?>
            <i class="fas fa-check-circle absolute top-5 right-5 text-green-600 text-3xl "></i>
        <?php else: ?>
            <i class="fas fa-exclamation-circle absolute top-5 right-5 text-yellow-600 text-3xl"></i>
        <?php endif; ?>

    </div>
    <div class="lg:col-span-2 col-span-3 flex flex-col gap-10">
        <div class="card w-full flex flex-col  items-center">
            <h1 class="text-2xl font-bold mb-5 underline">Blood Information</h1>
            <table class=" table-auto tbl">
                <tbody>
                    <tr>
                        <th>Blood Type:</th>
                        <td>
                            <?php echo $user['BloodType'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Rh Factor:</th>
                        <td>
                            <?php echo $blood['RhFactor'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Haemoglobin:</th>
                        <td>
                            <?php echo $blood['Haemoglobin'] ?> (g/dl)
                        </td>
                    </tr>
                    <tr>
                        <th>Pulse:</th>
                        <td>
                            <?php echo $blood['Pulse'] ?> bpm
                        </td>
                    </tr>
                    <tr>
                        <th>Blood Pressure:</th>
                        <td>
                            <?php echo $blood['BP'] ?> mmHg
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="card w-full flex flex-col items-center">
            <h1 class="text-2xl font-bold mb-5 underline">Disease History</h1>
            <table class="text-left table-auto tbl">
                <tbody>
                    <tr>
                        <th>Hepatitis B Virus:</th>
                        <td>
                            <?php if (isset($disease['HBV']) && $disease['HBV'] == 1) {
                                echo 'Positive';
                            } elseif (isset($disease['HBV']) && $disease['HBV'] == 0) {
                                echo 'Negative';
                            } else {
                                echo 'N/A';

                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <th>HIV:</th>
                        <td>
                            <?php if (isset($disease['HIV']) && $disease['HIV'] == 1) {
                                echo 'Positive';
                            } elseif (isset($disease['HIV']) && $disease['HIV'] == 0) {
                                echo 'Negative';
                            } else {
                                echo 'N/A';

                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Hepatitis C Virus:</th>
                        <td>
                            <?php if (isset($disease['HCV']) && $disease['HCV'] == 1) {
                                echo 'Positive';
                            } elseif (isset($disease['HCV']) && $disease['HCV'] == 0) {
                                echo 'Negative';
                            } else {
                                echo 'N/A';

                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Hepatitis E Virus:</th>
                        <td>
                            <?php if (isset($disease['HEV']) && $disease['HEV'] == 1) {
                                echo 'Positive';
                            } elseif (isset($disease['HEV']) && $disease['HEV'] == 0) {
                                echo 'Negative';
                            } else {
                                echo 'N/A';

                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Human T-lymphotropic Virus:</th>
                        <td>
                            <?php if (isset($disease['HTV']) && $disease['HTV'] == 1) {
                                echo 'Positive';
                            } elseif (isset($disease['HTV']) && $disease['HTV'] == 0) {
                                echo 'Negative';
                            } else {
                                echo 'N/A';

                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Malaria:</th>
                        <td>
                            <?php if (isset($disease['Malaria']) && $disease['Malaria'] == 1) {
                                echo 'Positive';
                            } elseif (isset($disease['Malaria']) && $disease['Malaria'] == 0) {
                                echo 'Negative';
                            } else {
                                echo 'N/A';

                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Active Tuberculosis:</th>
                        <td>
                            <?php if (isset($disease['TB']) && $disease['TB'] == 1) {
                                echo 'Positive';
                            } elseif (isset($disease['TB']) && $disease['TB'] == 0) {
                                echo 'Negative';
                            } else {
                                echo 'N/A';

                            } ?>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <?php if (!$alreadyConfirmed && $role == 'user'): ?>
        <div class="col-span-3 flex justify-center">
            <form target="frame" action="classes/confirm_donation.php" method="post">
                <input type="hidden" name="request" value=<?php echo $request; ?>>
                <input type="hidden" name="id" value=<?php echo $id; ?>>
                <button class="button" name="submit" type="submit" id="confirmDonationButton">
                    Confirm Donation
                </button>
            </form>

        </div>
    <?php endif; ?>

</div>

<script>

    const confirmButton = document.getElementById('confirmDonationButton');

    confirmButton.addEventListener('click', () => {
        confirmButton.innerHTML = "Donation Confirmed";
        confirmButton.classList.add('hidden');


    })


</script>



<?php
include "components/footer.php";
?>