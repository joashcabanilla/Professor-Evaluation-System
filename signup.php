<?php
ob_start();
session_start();
setcookie("ERROR", "");
setcookie("username", "");
setcookie("password", "");
setcookie("email-error","");
setcookie("student-button","flex");
setcookie("input-form","none");
setcookie("firstname","");
setcookie("firstname","");
setcookie("middlename","");
setcookie("lastname","");
setcookie("studentnumber","");
setcookie("email","");
setcookie("username","");
setcookie("password","");
setcookie("confirmpass","");
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
                    <p class="error-message" name="create-error"><?php if(isset($_COOKIE['email-error'])){echo $_COOKIE['email-error'];}?></p>
                    <div id="account-button" class="account-button" style="display:<?php if(isset($_COOKIE['student-button'])){echo $_COOKIE['student-button'];}else{echo "flex";}?>;">
                        <button class="selected-button" onclick="student()">STUDENT</button>
                        <button class="selected-button" onclick="professor()">PROFESSOR</button>
                    </div>
                    <div id="account-input" class="div-name" style="display:<?php if(isset($_COOKIE['input-form'])){echo $_COOKIE['input-form'];}else{echo "none";}?>;">
                        <input class="name" type="text" placeholder="First Name" name="firstname" value = "<?php if(isset($_COOKIE['firstname'])){echo $_COOKIE['firstname'];}?>" pattern="[A-Z a-z]{3,100}" title = "Invalid name" required>

                        <input class="name" type="text" placeholder="Middle Name" name="middlename" value = "<?php if(isset($_COOKIE['middlename'])){echo $_COOKIE['middlename'];}?>" pattern="[A-Z a-z]+" title = "Invalid name" required>

                        <input class="name" type="text" placeholder="Last Name" name="lastname" value = "<?php if(isset($_COOKIE['lastname'])){echo $_COOKIE['lastname'];}?>" pattern="[A-Z a-z]{3,100}" title = "Invalid name" required>

                        <input id="studentnumber" class="name" type="number" placeholder="Student Number" name="studentnumber" value = "<?php if(isset($_COOKIE['studentnumber'])){echo $_COOKIE['studentnumber'];}?>" title = "Enter the number only of your studentnumber" style="display:<?php if(isset($_COOKIE['account_type'])){if($_COOKIE['account_type'] == "student"){echo "flex";}else{echo "none";}} ?>;">

                        <input class="name" type="email" placeholder="Email" name="email" value = "<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'];}?>" required style="text-transform: lowercase;">

                        <input class="name" type="text" placeholder="Username" name="create-username" minlength="5" value = "<?php if(isset($_COOKIE['username'])){echo $_COOKIE['username'];}?>" required style="text-transform: lowercase;">

                        <input class="name" type="password" placeholder="Password" name="create-password" minlength="6" value = "<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];}?>" required style="text-transform: lowercase;">

                        <input class="name" type="password" placeholder="Confirm Password" name="confirm-password" minlength="6" value = "<?php if(isset($_COOKIE['confirmpass'])){echo $_COOKIE['confirmpass'];}?>" required style="text-transform: lowercase;">
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
                document.cookie = "account_type=student";
                student.required = true;
                document.cookie = "firstname=";
                document.cookie = "middlename=";
                document.cookie = "lastname=";
                document.cookie = "studentnumber=";
                document.cookie = "email=";
                document.cookie = "username=";
                document.cookie = "password=";
                document.cookie = "confirmpass=";
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
            document.cookie = "account_type=professor";
            student.required = false;
            document.cookie = "firstname=";
            document.cookie = "middlename=";
            document.cookie = "lastname=";
            document.cookie = "studentnumber=";
            document.cookie = "email=";
            document.cookie = "username=";
            document.cookie = "password=";
            document.cookie = "confirmpass=";
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