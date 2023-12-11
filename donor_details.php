<?php
session_start();
if (!isset($_SESSION['username']))
    header("Location:../");

include "components/header.php";
include "classes/dbconnect.php";


$username = $_SESSION['username'];

$raw_id = base64_decode($_GET['id']);
$id = preg_replace(sprintf('/%s/', 'salt'), '', $raw_id);


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
        'BP' => 'N/A'
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
                    2
                </h1>
            </div>
        </div>
        <h1 class="absolute top-3 right-3 py-2 px-4 badge">
            Unverified
        </h1>
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
                            <?php echo $disease['HBV'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>HIV:</th>
                        <td>
                            <?php echo $disease['HIV'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Hepatitis C Virus:</th>
                        <td>
                            <?php echo $disease['HCV'] ?> (g/dl)
                        </td>
                    </tr>
                    <tr>
                        <th>Hepatitis E Virus:</th>
                        <td>
                            <?php echo $disease['HEV'] ?> bpm
                        </td>
                    </tr>
                    <tr>
                        <th>Human T-lymphotropic Virus:</th>
                        <td>
                            <?php echo $disease['HTV'] ?> mmHg
                        </td>
                    </tr>
                    <tr>
                        <th>Malaria:</th>
                        <td>
                            <?php echo $disease['Malaria'] ?> mmHg
                        </td>
                    </tr>
                    <tr>
                        <th>Active Tuberculosis:</th>
                        <td>
                            <?php echo $disease['TB'] ?> mmHg
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>



<?php
include "components/footer.php";
?>