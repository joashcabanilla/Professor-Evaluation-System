<?php
ob_start();
session_start();
setcookie("ERROR", "");
setcookie("username", "");
setcookie("password", "");
$_SESSION['page'] = "signup.php";
if (isset($_SESSION['url'])) {
    header("Location:" . $_SESSION['url']);
}
ob_end_flush();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'header.php'; ?>
    <link rel="stylesheet" href="style/signup-style.css">
</head>
<body>
    <div class="container">
        <div class="csd">
            <img src="image/csd.png" alt="csd" width="380" height="200">
        </div>
        <div class="container2">
            <div class="create-form">
                <form action="create-account.php" method="POST">
                    <h1>Create Account</h1>
                    <p class="error-message" name="create-error"></p>
                    <div id="account-button" class="account-button" style="display:flex;">
                        <button class="selected-button" onclick="student()">STUDENT</button>
                        <button class="selected-button" onclick="professor()">PROFESSOR</button>
                    </div>
                    <div id="account-input" class="div-name" style="display:none;">
                        <input class="name" type="text" placeholder="First Name" name="firstname" required>
                        <input class="name" type="text" placeholder="Middle Name" name="middlename" required>
                        <input class="name" type="text" placeholder="Last Name" name="lastname" required>
                        <input id="studentnumber" class="name" type="number" oninput="validity.valid||(value='');" onpress="isNumber(event)" placeholder="Student Number" name="studentnumber" required">
                        <input class="name" type="email" placeholder="Email" name="email" required style="text-transform: lowercase;">
                        <input class="name" type="text" placeholder="Username" name="create-username" required style="text-transform: lowercase;">
                        <input class="name" type="password" placeholder="Password" name="create-password" required style="text-transform: lowercase;">
                        <input class="name" type="password" placeholder="Confirm Password" name="confirm-password" required style="text-transform: lowercase;">
                        <div class="div-signup">
                            <button class="selected-button" type="submit" name="signup-button" style="height: 50px;">SIGN UP</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="div-login">
                <p class="login-label">Already have an Account?<a class="login" href="index.php">Log In</a></p>
            </div>
        </div>
    </div>
    <script>
        function student() {
        var x = document.getElementById("account-button");
        var input = document.getElementById("account-input");
        var student = document.getElementById("studentnumber");
            if(x.style.display == "flex")
            {
                x.style.display = "none";
                input.style.display = "flex";
            }
        }
        function professor() {
        var x = document.getElementById("account-button");
        var input = document.getElementById("account-input");
        var student = document.getElementById("studentnumber");
        if(x.style.display == "flex")
        {
            x.style.display = "none";
            input.style.display = "flex";
            student.style.display = "none";
        }
        }
    </script>
</body>
<script language="JavaScript">
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        let charCode = (evt.which) ? evt.which : evt.keyCode;
        if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
            evt.preventDefault();
        } else {
            return true;
        }
    }
</script>
</html>