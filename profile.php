<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'user')
    header("Location:index.php");

include "components/header.php";
include "classes/dbconnect.php";


$username = $_SESSION['username'];
$role = $_SESSION['role'];



$sql = "SELECT * FROM bloodinformation WHERE Username = '$username'";
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

$sql = "SELECT * FROM diseasehistory WHERE Username = '$username'";
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

$sql = "SELECT hospital.Name as HospitalName,users.VerifiedOn,users.PhoneNo,users.Username,users.Name,users.DOB,users.Gender,users.BloodType,users.Address FROM users left join hospital on users.HospitalID=hospital.HospitalID WHERE users.Username = '$username'";
$result = mysqli_query($con, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
}

$verifiedOn = new DateTime($row['VerifiedOn']);
$verifiedTill = $verifiedOn->add(new DateInterval('P1Y'));


?>

<div class="w-full text-center">
    <h1 class="text-3xl mb-10">Update Profile</h1>
    <form action="classes/update.php" method="post" class="w-full grid grid-cols-2 gap-4">
        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="Username" class="font-bold">Username</label>
            <input disabled class="rounded shadow-inner bg-red-900 p-2" type="text" name="Username" id="Username"
                value="<?php echo $row['Username']; ?>">
        </div>
        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="Name" class="font-bold">Full Name</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="text" name="Name" id="Name"
                value="<?php echo $row['Name']; ?>">
        </div>


        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="PhoneNo" class="font-bold">Phone</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="number" name="PhoneNo" id="PhoneNo"
                value="<?php echo $row['PhoneNo']; ?>">
        </div>

        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="DOB" class="font-bold">Date of Birth</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="date" name="DOB" id="DOB"
                value="<?php echo $row['DOB']; ?>">
        </div>





        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="Gender" class="font-bold">Gender</label>
            <select required id="Gender" name="Gender" class="rounded shadow-inner bg-red-900 p-2">
                <option value="">Select One</option>
                <option value="Male" <?php if ($row['Gender'] == 'Male')
                    echo "selected"; ?>>Male</option>
                <option value="Female" <?php if ($row['Gender'] == 'Female')
                    echo "selected"; ?>>Female</option>
                <option value="Others" <?php if ($row['Gender'] == 'Others')
                    echo "selected"; ?>>Others</option>
            </select>
        </div>



        <div class="flex flex-col text-center col-span-2 md:col-span-1">
            <label for="BloodType" class="font-bold">Blood Type</label>
            <select id="BloodType" name="BloodType" class="rounded shadow-inner bg-red-900 p-2" required>
                <?php if ($row['VerifiedOn'] != NULL && $verifiedTill > new DateTime() && $blood['BloodType'] != NULL): ?>

                    <option value="">Select One</option>
                    <option value="A+" <?php if ($blood['BloodType'] == 'A+')
                        echo "selected"; ?>>A+</option>
                    <option value="A-" <?php if ($blood['BloodType'] == 'A-')
                        echo "selected"; ?>>A-</option>
                    <option value="B+" <?php if ($blood['BloodType'] == 'B+')
                        echo "selected"; ?>>B+</option>
                    <option value="B-" <?php if ($blood['BloodType'] == 'B-')
                        echo "selected"; ?>>B-</option>
                    <option value="AB+" <?php if ($blood['BloodType'] == 'AB+')
                        echo "selected"; ?>>AB+</option>
                    <option value="AB-" <?php if ($blood['BloodType'] == 'AB-')
                        echo "selected"; ?>>AB-</option>
                    <option value="O+" <?php if ($blood['BloodType'] == 'O+')
                        echo "selected"; ?>>O+</option>
                    <option value="O-" <?php if ($blood['BloodType'] == 'O-')
                        echo "selected"; ?>>O-</option>

                <?php else: ?>
                    <option value="">Select One</option>
                    <option value="A+" <?php if ($row['BloodType'] == 'A+')
                        echo "selected"; ?>>A+</option>
                    <option value="A-" <?php if ($row['BloodType'] == 'A-')
                        echo "selected"; ?>>A-</option>
                    <option value="B+" <?php if ($row['BloodType'] == 'B+')
                        echo "selected"; ?>>B+</option>
                    <option value="B-" <?php if ($row['BloodType'] == 'B-')
                        echo "selected"; ?>>B-</option>
                    <option value="AB+" <?php if ($row['BloodType'] == 'AB+')
                        echo "selected"; ?>>AB+</option>
                    <option value="AB-" <?php if ($row['BloodType'] == 'AB-')
                        echo "selected"; ?>>AB-</option>
                    <option value="O+" <?php if ($row['BloodType'] == 'O+')
                        echo "selected"; ?>>O+</option>
                    <option value="O-" <?php if ($row['BloodType'] == 'O-')
                        echo "selected"; ?>>O-</option>

                <?php endif; ?>

            </select>
        </div>

        <div class="flex flex-col text-center col-span-2 ">
            <label for="Address" class="font-bold">Location</label>
            <input required class="rounded shadow-inner bg-red-900 p-2" type="text" name="Address" id="Address"
                value="<?php echo $row['Address']; ?>">
        </div>
        <button class="col-span-2 button bg-red-900 px-8" type="submit">Submit</button>
    </form>

    <div class="mt-20">
        <h1 class="text-3xl mb-10">Medical Verification</h1>
        <div class="w-full flex flex-col items-center">

            <?php
            if ($row['VerifiedOn'] != NULL && $verifiedTill > new DateTime()):
                ?>
                <table class="text-left table-auto tbl">
                    <tbody>
                        <tr>
                            <th>Verified From:</th>
                            <td>
                                <?php echo $row['HospitalName'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Verifed On:</th>
                            <td>
                                <?php echo $row['VerifiedOn'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Verifed Till:</th>
                            <td>
                                <?php echo $verifiedTill->format('Y-m-d') ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Blood Type:</th>
                            <td>
                                <?php echo $blood['BloodType'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Rh Factor:</th>
                            <td>
                                <?php echo $blood['RhFactor'] ?>
                            </td>
                        </tr>
                        <br>
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

            <?php else: ?>
                <h1 class="text-xl  mb-5">Not Verified. Please get verified from one of our recognized hospitals.
                </h1>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    const DOBElement = document.getElementById("DOB");

    DOBElement.addEventListener("change", function () {
        const today = new Date();
        const DOB = new Date(DOBElement.value);
        const validAge = new Date(DOB.getFullYear() + 18, DOB.getMonth(), DOB.getDate());

        console.log(validAge);

        if (validAge > today) {
            alert("You need to be at least 16 years old to be a user.");
            DOBElement.value = "";
        }
    });
</script>



<?php
include "components/footer.php";
?>