<?php
session_start();
if (!isset($_SESSION['username']))
    header("Location:../");

include "components/header.php";
include "classes/dbconnect.php";

$username = $_SESSION['username'];


$sql = "SELECT * FROM `donorapplication` RIGHT JOIN `donationrequest` ON donorapplication.DonationRequestID = donationrequest.DonationRequestID WHERE donationrequest.CreatedBy != '$username' AND donorapplication.DonorUsername IS NULL AND datediff( now(),donationrequest.CreatedOn) <=3 AND donationrequest.RequestActive=1 ORDER BY donationrequest.CreatedOn DESC";

$result = mysqli_query($con, $sql);
$donationRequests = array();
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($donationRequests, $row);
    }
}

?>

<div class="grid grid-cols-2 gap-10">

    <?php foreach ($donationRequests as $idx => $donationRequest): ?>

        <div class="card col-span-2 lg:col-span-1">
            <div class="grid grid-cols-4 gap-2 ">
                <div class="col-span-3">
                    <h1 class="text-2xl">
                        <?php echo $donationRequest['Description']; ?>
                    </h1>
                    <div class="flex gap-2 my-3 text-white/70 items-center text-sm">
                        <h1 class="">Created:</h1>
                        <h1 class="">
                            <?php
                            $createdOn = new DateTime($donationRequest['CreatedOn']);
                            echo $createdOn->format('M d, Y');
                            ?>
                        </h1>
                    </div>
                </div>
                <div class="col-span-1">
                    <form target="frame" action="classes/donate.php" method="post">
                        <input type="hidden" name="id" value=<?php echo $donationRequest['DonationRequestID']; ?>>
                        <button onclick="handleDonate(<?php echo $idx ?>)" id="btn<?php echo $idx ?>" type="submit"
                            class="button md:w-28 md:text-lg w-24 text-sm font-bold">
                            Donate
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
                            <?php echo $donationRequest['DonationType']; ?>
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
                            <?php echo $donationRequest['BloodType']; ?>
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
                            <?php echo $donationRequest['Quantity']; ?> ml
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
                            <?php echo $donationRequest['HospitalName']; ?>
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
                            <?php echo $donationRequest['HospitalAddress']; ?>
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
                            <?php echo $donationRequest['PatientName']; ?>
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
                            <?php echo $donationRequest['PatientAge']; ?>
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
                            $neededOn = new DateTime($donationRequest['NeededOn']);
                            echo $neededOn->format('M d, Y D');
                            ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

</div>

<script>
    function handleDonate(idx) {
        console.log(idx);
        document.getElementById(`btn${idx}`).innerHTML = "Donated";
        document.getElementById(`btn${idx}`).classList.add("inactive");
        document.getElementById(`btn${idx}`).classList.remove("bg-red-500");
        document.getElementById(`btn${idx}`).classList.remove("button");
    }
</script>


<?php
include "components/footer.php"
    ?>