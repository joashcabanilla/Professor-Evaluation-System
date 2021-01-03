<?php
ob_start();
session_start();
setcookie("ERROR","");
setcookie("username","");
setcookie("password","");
$_SESSION['page'] = "signup.php";
if(isset($_SESSION['url']))
{
    header("Location:".$_SESSION['url']);
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
        <div class="create-form">
            <form action="create-account.php" method="POST">
                <h1>Create Account</h1>
                <p class="error-message" name="create-error"></p>
                <div class="account-button" style="display: none;">
                    <button class="selected-button" type="submit" name="student-button">STUDENT</button>
                    <button class="selected-button" type="submit" name="professor-button">PROFESSOR</button>
                </div>
                <div class="div-name" style="display: flex;">
                    <input class="name" type="text" placeholder="First Name" name="firstname" required>
                    <input class="name" type="text" placeholder="Middle Name" name="middlename" required>
                    <input class="name" type="text" placeholder="Last Name" name="lastname" required>
                    <input class="name" type="number" oninput="validity.valid||(value='');" onpress="isNumber(event)" placeholder="Student Number" name="studentnumber" required>
                    <input class="name" type="email" placeholder="Email" name="email" required>
                    <input class="name" type="text" placeholder="Username" name="create-username" required>
                    <input class="name" type="password" placeholder="Password" name="create-password" required>
                    <input class="name" type="password" placeholder="Confirm Password" name="confirm-password" required>
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