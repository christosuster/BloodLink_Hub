<?php
session_start();
if (!isset($_SESSION['username']))
    header("Location:../");

include "components/header.php";
include "classes/dbconnect.php";

$username = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE `Username` = '$username'";
$result = mysqli_query($con, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $userInfo = mysqli_fetch_array($result);
}

$sql = "SELECT * FROM donationrequest WHERE `CreatedBy` = '$username' AND `ExpiryDate` > NOW() ORDER BY `CreatedOn` DESC";
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

$sql = "SELECT * FROM `donorapplication` INNER JOIN `donationrequest` ON donorapplication.DonationRequestID = donationrequest.DonationRequestID WHERE donorapplication.DonorUsername = '$username' AND donationrequest.ExpiryDate > NOW() ORDER BY donationrequest.CreatedOn DESC";
$result = mysqli_query($con, $sql);
$donationApplication = array();
if ($result && mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        array_push($donationApplication, $row);
    }
}

?>


<div class="grid grid-cols-6 gap-10">
    <div class="col-span-6 md:col-span-2 lg:col-span-2 card">
        <div class="flex flex-col items-center justify-center">
            <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="w-32 h-32 rounded-full">
            <div class="flex flex-col items-center justify-center my-3">
                <h2 class="text-xl font-bold">
                    <?php echo $userInfo['Name']; ?>
                </h2>
                <h4 class="text-lg">
                    <?php echo $userInfo['Username']; ?>
                </h4>
            </div>
            <button class="button">Edit Profile</button>
        </div>

    </div>

    <div class="col-span-6 md:col-span-4 lg:col-span-4 card w-full ">

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
                    <th>Verified Status</th>
                    <td>
                        Unverified
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <div class="col-span-6 md:col-span-6 lg:col-span-3 card flex flex-col  items-center ">
        <h1 class="text-2xl mb-5">Donation History</h1>
        <div class="h-[300px] overflow-y-auto w-full">
            <table class="table-fixed w-full border-separate border-spacing-2 text-center ">
                <thead class="">
                    <tr>
                        <th>Date</th>
                        <th>Donation Type</th>
                        <th>Quantity</th>
                        <th>Hospital</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2023-02-05</td>
                        <td>Platelets</td>
                        <td>300 ml</td>
                        <td>Regional Medical Center</td>
                    </tr>
                    <tr>
                        <td>2023-01-15</td>
                        <td>Whole Blood</td>
                        <td>450 ml</td>
                        <td>City General Hospital</td>
                    </tr>
                    <tr>
                        <td>2023-03-20</td>
                        <td>Plasma</td>
                        <td>200 ml</td>
                        <td>Community Health Center</td>
                    </tr>
                    <tr>
                        <td>2023-04-10</td>
                        <td>Red Cells</td>
                        <td>500 ml</td>
                        <td>University Hospital</td>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>

    <div class="col-span-6 md:col-span-6 lg:col-span-3 ">
        <div class="grid grid-cols-2 gap-10">
            <div class="card col-span-2  flex flex-col items-center w-full ">
                <h1 class="text-2xl mb-5">Donation Request History</h1>
                <div class="h-[200px] overflow-y-auto w-full">



                    <?php foreach ($donations as $donation): ?>

                        <div onclick="window.location.href='request_history.php?id=<?php echo $donation['DonationRequestID']; ?>'"
                            class="flex flex-col items-center w-full cursor-pointer hover:shadow-xl py-3 my-2 hover:bg-white/5 rounded ">
                            <div class="grid grid-cols-6  gap-4 w-full justify-center items-center">
                                <h1 class="text-3xl col-span-1 mx-auto">
                                    <?php echo $donation['BloodType']; ?>
                                </h1>
                                <div class="col-span-4 border-r-2">
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
            <div class="card col-span-2  flex flex-col items-center w-full ">
                <h1 class="text-2xl mb-5">Volunteered to Donate to</h1>
                <div class="h-[200px] overflow-y-auto w-full">

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
    </div>
</div>


<?php
include "components/footer.php";
?>