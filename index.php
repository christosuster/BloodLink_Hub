<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Blood Bank</title>
</head>

<body>

    <h1 class="text-3xl">Welcome to Blood Link Hub</h1>
    <h3 class="texl-lg mb-8">Sharing Blood, Sharing Hope.</h3>

    <div class="forms">
        <div class="tab">
            <a href="#" id="loginTab" class="activeTab" style="border-top-left-radius: 16px;">Login</a>
            <a href="#" id="signupTab" class="inactiveTab" style="border-top-right-radius: 16px;">Sign Up</a>
        </div>
        <div class="form">
            <form id="loginForm" method="POST" action="classes/login.php">
                <label for="loginUsername">Username</label>
                <input type="text" id="loginUsername" name="loginUsername" required>

                <label for="loginPassword">Password</label>
                <input type="password" id="loginPassword" name="loginPassword" required>

                <button type="submit" name="submit">Login</button>
            </form>



            <form id="signupForm" style="display: none;" method="POST" action="classes/register.php"
                onSubmit="return validate()">
                <div class="w-full hidden" id="passError">
                    <h1 class="text-center text-xl bg-yellow-500 text-red-700">Passwords do not match!</h1>
                </div>
                <label for="signupUsername">Username</label>
                <input type="text" id="signupUsername" name="signupUsername" required>

                <label for="signupPassword">Password</label>
                <input type="password" id="signupPassword" name="signupPassword" required>

                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>

                <button type="submit" name="submit">Sign Up</button>
            </form>
        </div>
    </div>



    <script>
        function validate() {
            var password = document.getElementById("signupPassword").value;
            var confirmPassword = document.getElementById("confirmPassword").value;
            if (password != confirmPassword) {
                document.getElementById('passError').style.display = "block";
                return false;
            }
            else {
                document.getElementById('passError').style.display = "none";
                return true;
            }
        }

        document.getElementById("loginTab").addEventListener("click", function () {
            document.getElementById("loginForm").style.display = "block";
            document.getElementById("signupForm").style.display = "none";
            document.getElementById("loginTab").classList.add("activeTab");
            document.getElementById("loginTab").classList.remove("inactiveTab");
            document.getElementById("signupTab").classList.remove("activeTab");
            document.getElementById("signupTab").classList.add("inactiveTab");
        });

        document.getElementById("signupTab").addEventListener("click", function () {
            document.getElementById("loginForm").style.display = "none";
            document.getElementById("signupForm").style.display = "block";
            document.getElementById("signupTab").classList.add("activeTab");
            document.getElementById("signupTab").classList.remove("inactiveTab");
            document.getElementById("loginTab").classList.remove("activeTab");
            document.getElementById("loginTab").classList.add("inactiveTab");
        });
    </script>
</body>

</html>