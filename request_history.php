<?php
include "components/header.php";

if ($_SESSION['role'] != 'user')
    header("Location:index.php");

$id = $_GET['id'];

$sql = "SELECT * FROM users INNER JOIN donorapplication ON donorapplication.DonorUsername = users.Username WHERE donorapplication.DonationRequestID = '$id'";
$result = mysqli_query($con, $sql);
$donors = array();
if ($result && mysqli_num_rows($result) > 0) {


    while ($donorRow = mysqli_fetch_assoc($result)) {
        array_push($donors, $donorRow);
    }
}


$sql = "SELECT * FROM donationrequest WHERE `DonationRequestID` = '$id' AND `CreatedBy` = '$username'";
$result = mysqli_query($con, $sql);
if ($result && mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);
} else {
    header("Location:error.php?error=Invalid Request");
}

$deactivateOn = new DateTime($row['DeactivateOn']);
$timeNow = new DateTime();
$interval = $timeNow->diff($deactivateOn);
$difference = $interval->days * 24 + $interval->h;
$isNegative = $interval->invert;


?>

<div class="grid grid-cols-5 gap-10">
    <div class="card col-span-5 lg:col-span-3">
        <div class="grid grid-cols-4 gap-2 ">
            <div class="col-span-3">
                <h1 class="text-2xl">
                    <?php echo $row['Description']; ?>
                </h1>
                <div class=" gap-2 my-3 text-white/70  text-sm">
                    <h1 class="text-xs text-white/50 arimo font-bold">
                        Created:
                        <?php
                        $createdOn = new DateTime($row['CreatedOn']);
                        echo $createdOn->format('d M Y h:i A');
                        ?>

                    </h1>

                    <?php if (!$isNegative): ?>

                        <div class="text-white/50 arimo font-bold flex my-1">
                            <i class="fa fa-hourglass-start" aria-hidden="true"></i>
                            <h1 class="px-2 text-xs">
                                <?php echo $difference; ?>
                                Hours Left
                            </h1>
                        </div>
                    <?php endif; ?>


                </div>

            </div>
            <div class="col-span-1">
                <form target="frame" action="classes/deactivate.php" method="post">
                    <input type="hidden" name="id" value=<?php echo $row['DonationRequestID']; ?>>
                    <button type="submit" name="submit"
                        class="button bg-red-900 md:w-28 md:text-lg w-24 text-sm font-bold" id="status">
                        <?php



                        if (!$isNegative && $row['RequestActive'] == 1) {
                            echo "Active";
                        } else {
                            echo "Inactive";
                        }
                        ?>
                    </button>
                </form>

            </div>


        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 justify-between w-full">
            <div class="flex items-center gap-3 my-2">
                <div class="w-8">
                    <i class="fas fa-hands-helping text-xl"></i>
                </div>

                <div>
                    <h1 class="text-sm text-white/70 leading-none">Donation Type</h1>
                    <h1 class="">
                        <?php echo $row['DonationType']; ?>
                    </h1>
                </div>
            </div>

            <div class="flex items-center gap-3 my-2">
                <div class="w-8">
                    <i class="fas fa-tint text-xl"></i>
                </div>

                <div>
                    <h1 class="text-sm text-white/70 leading-none">Blood Type</h1>
                    <h1 class="">
                        <?php echo $row['BloodType']; ?>
                    </h1>
                </div>
            </div>

            <div class="flex items-center gap-3 my-2">
                <!-- Quantity -->
                <div class="w-8">
                    <i class="fas fa-flask text-xl"></i>
                </div>
                <div>
                    <h1 class="text-sm text-white/70 leading-none">Quantity</h1>
                    <h1 class="">
                        <?php echo $row['Quantity']; ?>
                    </h1>
                </div>
            </div>

            <div class="flex items-center gap-3 my-2">
                <!-- Hospital Name -->
                <div class="w-8">
                    <i class="fas fa-hospital text-xl"></i>
                </div>
                <div>
                    <h1 class="text-sm text-white/70 leading-none">Hospital Name</h1>
                    <h1 class="">
                        <?php echo $row['HospitalName']; ?>
                    </h1>
                </div>
            </div>

            <div class="flex items-center gap-3 my-2">
                <!-- Hospital Address -->
                <div class="w-8">
                    <i class="fas fa-map-marker-alt text-xl"></i>
                </div>
                <div>
                    <h1 class="text-sm text-white/70 leading-none">Hospital Address</h1>
                    <h1 class="">
                        <?php echo $row['HospitalAddress']; ?>
                    </h1>
                </div>
            </div>

            <div class="flex items-center gap-3 my-2">
                <!-- Patient Name -->
                <div class="w-8">
                    <i class="fas fa-user text-xl"></i>
                </div>
                <div>
                    <h1 class="text-sm text-white/70 leading-none">Patient Name</h1>
                    <h1 class="">
                        <?php echo $row['PatientName']; ?>
                    </h1>
                </div>
            </div>

            <div class="flex items-center gap-3 my-2">
                <!-- Patient Age -->
                <div class="w-8">
                    <i class="fas fa-birthday-cake text-xl"></i>
                </div>
                <div>
                    <h1 class="text-sm text-white/70 leading-none">Patient Age</h1>
                    <h1 class="">
                        <?php echo $row['PatientAge']; ?>
                    </h1>
                </div>
            </div>

            <div class="flex items-center gap-3 my-2">
                <!-- Needed on Date -->
                <div class="w-8">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
                <div>
                    <h1 class="text-sm text-white/70 leading-none">Needed On</h1>
                    <h1 class="">
                        <?php
                        $neededOn = new DateTime($row['NeededOn']);
                        echo $neededOn->format('M d, Y D');
                        ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-5 lg:col-span-2 card">
        <h1 class="text-3xl text-center mb-10">Interested Donors</h1>
        <div class="max-h-[220px] overflow-y-auto">
            <?php foreach ($donors as $donor): ?>

                <div class="my-3 px-4 py-2 item">
                    <div class="flex justify-between w-full">
                        <div class="flex gap-2 items-center">
                            <h1 class="text-2xl font-bold">
                                <?php echo $donor['BloodType']; ?>
                            </h1>
                            <div>
                                <h1 class="text-lg leading-none">
                                    <?php echo $donor['Name'] ?>
                                </h1>
                                <h1 class="text-sm">
                                    <?php echo $donor['Address'] ?>
                                </h1>
                            </div>
                        </div>
                        <button class=" mx-0 button bg-red-900"
                            onclick="window.location.href='donor_details.php?id=<?php echo base64_encode($donor['Username'] . 'salt'); ?>&request=<?php echo base64_encode($row['DonationRequestID'] . 'salt'); ?>'">View</button>
                    </div>


                </div>
            <?php endforeach; ?>


        </div>
    </div>
</div>

<script>
    const status = document.getElementById('status');

    if (status.innerText == "Inactive") {
        status.classList.add('inactive');
        status.classList.remove('button');
    }

    status.addEventListener('click', () => {

        status.innerText = "Inactive";
        status.classList.add('inactive');
        status.classList.remove('button');

    })

    status.addEventListener('mouseover', () => {
        if (status.innerText == "Active") {
            status.innerText = "Deactivate";
        }
    })

    status.addEventListener('mouseout', () => {
        if (status.innerText == "Deactivate") {
            status.innerText = "Active";
        }
    })


</script>


<?php
include "components/footer.php";
?>