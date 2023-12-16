<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['role']))
    header("Location:index.php");

include "components/header.php";
include "classes/dbconnect.php";

$username = $_SESSION['username'];
$role = $_SESSION['role'];

if ($role == 'user') {
    $sql = "SELECT * FROM users WHERE `Username` = '$username'";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $userInfo = mysqli_fetch_array($result);
    }

    $sql = "SELECT * FROM donationrequest WHERE `CreatedBy` = '$username' ORDER BY `CreatedOn` DESC";
    $result = mysqli_query($con, $sql);
    $donations = array();
    if ($result && mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($donations, $row);
        }
    }

    $sql = "SELECT * FROM donationhistory WHERE `Username` = '$username'";
    $result = mysqli_query($con, $sql);
    $donationHistory = array();
    if ($result && mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($donationHistory, $row);
        }
    }

    $sql = "SELECT * FROM `donorapplication` INNER JOIN `donationrequest` ON donorapplication.DonationRequestID = donationrequest.DonationRequestID WHERE donorapplication.DonorUsername = '$username' AND donationrequest.ExpiryDate > NOW() AND donorapplication.HasDonated = 0 ORDER BY donationrequest.CreatedOn DESC";
    $result = mysqli_query($con, $sql);
    $donationApplication = array();
    if ($result && mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($donationApplication, $row);
        }
    }

    $sql = "select * from donationhistory where Username = '$username'";
    $result = mysqli_query($con, $sql);
    $donationHistory = array();
    if ($result && mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($donationHistory, $row);
        }
    }

    $verifiedOn = new DateTime($userInfo['VerifiedOn']);
    $verifiedTill = $verifiedOn->add(new DateInterval('P1Y'));


} elseif ($role == "superuser") {
    $sql = "SELECT * FROM users WHERE `Username` = '$username' AND `Role` = 'superuser'";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $userInfo = mysqli_fetch_array($result);
    }

}



?>


<?php if ($role == 'user'): ?>
    <div class="grid grid-cols-6 gap-10">
        <div class="col-span-6 lg:col-span-3 card">
            <div class="flex flex-col items-center justify-center">
                <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="w-32 h-32 rounded-full">
                <div class="w-full flex flex-col items-center justify-center my-3">
                    <h2 class="text-xl font-bold">
                        <?php echo $userInfo['Name']; ?>
                    </h2>
                    <h4 class="text-lg">
                        <?php echo $userInfo['Username']; ?>
                    </h4>
                    <table class=" table-auto tbl mx-auto lg:mx-0 lg:text-lg">
                        <tbody>
                            <tr>
                                <th>Date of Birth:</th>
                                <td>
                                    <?php echo $userInfo['DOB'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Gender:</th>
                                <td>
                                    <?php echo $userInfo['Gender'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Blood Type:</th>
                                <td>
                                    <?php echo $userInfo['BloodType'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Location:</th>
                                <td>
                                    <?php echo $userInfo['Address'] ?>
                                </td>
                            </tr>

                            <tr>
                                <th>Number of Donations:</th>
                                <td>
                                    <?php echo count($donationHistory) ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <?php if ($userInfo['VerifiedOn'] != NULL && $verifiedTill > new DateTime()): ?>Verified
                                        <i class="fas fa-check-circle text-green-600  "></i>
                                    <?php else: ?>Unverified
                                        <i class="fas fa-exclamation-circle text-yellow-600 "></i>
                                    <?php endif; ?>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <button class="button bg-red-900/50 px-8">Edit Profile</button>
            </div>

        </div>

        <div class="col-span-6 lg:col-span-3 card flex flex-col  items-center ">
            <h1 class="text-2xl mb-5">Donation History</h1>
            <div class="h-full min-h-[300px] overflow-y-auto w-full h-full bg-red-900/50">
                <table class="w-full text-center table-auto">
                    <thead class="bg-red-900 ">
                        <tr class="text-sm text-white/70 h-12 ">
                            <th class="font-normal">Date</th>
                            <th class="font-normal">Donation</th>
                            <th class="font-normal">Hospital</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($donationHistory as $history): ?>
                            <tr class="">
                                <td class="py-3">
                                    <?php echo $history['DonationDate']; ?>
                                </td>
                                <td>
                                    <div class="flex w-full justify-center">
                                        <div class="flex justify-center items-center">

                                            <p class="text-2xl mr-4">
                                                <?php echo $history['BloodType']; ?>

                                            </p>
                                        </div>
                                        <div class="flex leading-none flex-col text-left">
                                            <p class="font-bold">

                                                <?php echo $history['DonationType']; ?>
                                            </p>
                                            <p>

                                                <?php echo $history['DonationAmount']; ?> ml
                                            </p>
                                        </div>
                                    </div>

                                </td>

                                <td>
                                    <?php echo $history['HospitalName']; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>


        </div>


        <div class="card col-span-6 lg:col-span-3  flex flex-col items-center w-full ">
            <h1 class="text-2xl mb-5">Donation Request History</h1>
            <div class="h-[300px] overflow-y-auto w-full">



                <?php foreach ($donations as $donation): ?>
                    <?php
                    $timeNow = new DateTime();
                    $deactivateOn = new DateTime($donation['DeactivateOn']);
                    $interval = $timeNow->diff($deactivateOn);
                    $difference = $interval->days * 24 + $interval->h;
                    $isNegative = $interval->invert;
                    ?>

                    <div onclick="window.location.href='request_history.php?id=<?php echo $donation['DonationRequestID']; ?>'"
                        class="flex item flex-col items-center w-full cursor-pointer py-3 my-2 ">

                        <div class="grid grid-cols-6  gap-4 w-full justify-center items-center">
                            <h1 class="text-4xl col-span-1 mx-auto">
                                <?php echo $donation['BloodType']; ?>
                            </h1>

                            <div class="col-span-4 border-r-2">
                                <h1 class="text-xs text-white/50 arimo font-bold">
                                    Created:
                                    <?php
                                    $createdOn = new DateTime($donation['CreatedOn']);
                                    echo $createdOn->format('d M Y h:i A');
                                    ?>

                                </h1>

                                <?php if (!$isNegative): ?>

                                    <div class="text-xs text-white/50 arimo font-bold flex">
                                        <i class="fa fa-hourglass-start" aria-hidden="true"></i>
                                        <h1 class="px-2 text-xs">
                                            <?php echo $difference; ?>
                                            Hours Left
                                        </h1>
                                    </div>
                                <?php endif; ?>

                                <?php if ($isNegative)
                                    echo '<h1 class="text-xs text-white/50 arimo font-bold">Inactive</h1>' ?>


                                    <h1 class="">
                                    <?php echo $donation['DonationType']; ?>
                                </h1>
                                <h1 class="text-lg">
                                    <?php echo $donation['HospitalName']; ?>
                                </h1>

                                <h1 class="text-sm">
                                    <?php echo $donation['NeededOn']; ?>
                                </h1>
                            </div>
                            <div class="mx-auto flex flex-col items-center justify-center">
                                <i class="fa fa-users text-lg" aria-hidden="true"></i>
                                <h1>
                                    <?php
                                    $sql = "SELECT COUNT(*) AS `Count` FROM `donorapplication` WHERE `DonationRequestID` = '" . $donation['DonationRequestID'] . "'";
                                    $result = mysqli_query($con, $sql);
                                    if ($result) {
                                        $count = mysqli_fetch_array($result);
                                        echo $count['Count'];
                                    }
                                    ?>
                                </h1>
                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>




            </div>
        </div>
        <div class="card col-span-6 lg:col-span-3  flex flex-col items-center w-full ">
            <h1 class="text-2xl mb-5">Volunteered to Donate to</h1>
            <div class="h-[300px] overflow-y-auto w-full">

                <?php foreach ($donationApplication as $donation): ?>
                    <div class="flex flex-col items-center w-full hover:shadow-lg py-2 my-2 hover:bg-white/5 rounded ">
                        <div class="grid grid-cols-6  gap-4 w-full justify-center items-center">
                            <div class="col-span-5 flex flex-col ">
                                <h1 class="font-bold mx-auto">
                                    <?php echo $donation['CreatedOn'] ?>
                                </h1>
                                <div class="mx-auto text-center">
                                    <h1 class="text-lg leading-none">
                                        <?php echo $donation['HospitalName'] ?>
                                    </h1>
                                    <h1 class="text-sm">
                                        <?php echo $donation['HospitalAddress'] ?>
                                    </h1>
                                </div>
                                <div class="grid grid-cols-2 my-3">
                                    <div class="flex flex-col items-center">

                                        <h1 class="font-bold">
                                            <?php echo $donation['PatientName'] ?>
                                        </h1>
                                        <h1 class="text-sm">
                                            <?php echo $donation['PatientAge'] ?> Years Old
                                        </h1>

                                    </div>
                                    <div class="flex flex-col items-center">
                                        <h1 class="font-bold">
                                            <?php echo $donation['BloodType'] ?>
                                        </h1>
                                        <h1 class="text-sm">
                                            <?php echo $donation['DonationType'] ?>
                                        </h1>
                                    </div>
                                </div>


                            </div>
                            <form action="classes/unvolunteer.php" method="post">
                                <input type="hidden" name="id" value=<?php echo $donation['DonorApplicationID']; ?>>
                                <button name="submit" type="submit" class="col-span-1 border w-10 h-10 mx-auto">
                                    <i class="fa fa-times text-lg " aria-hidden="true"></i>
                                </button>

                            </form>
                        </div>

                    </div>

                <?php endforeach; ?>



            </div>
        </div>
    </div>


<?php elseif ($role == 'superuser'): ?>
    <div>
        <h1 class="text-3xl text-center mb-10">Super User Dashboard</h1>
        <div class="grid grid-cols-6 gap-10">
            <div class="col-span-6 lg:col-span-2 card">
                <div class="flex flex-col items-center justify-center">
                    <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="w-32 h-32 rounded-full">
                    <div class="w-full flex flex-col items-center justify-center my-3">
                        <h2 class="text-xl font-bold">
                            <?php echo $userInfo['Name']; ?>
                        </h2>
                        <h4 class="text-lg">
                            <?php echo $userInfo['Username']; ?>
                        </h4>

                    </div>

                </div>

            </div>
            <div class="col-span-6 lg:col-span-2 card">

            </div>

        </div>
    </div>
<?php endif; ?>




<?php
include "components/footer.php";
?>