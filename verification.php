<?php
ob_start();
session_start();
require_once('database-config.php');
if(!isset($_GET['Email']))
{
    header("Location:signup.php");
}
if(isset($_POST['submit-code']))
{
$code = $_POST['code'];
$email = $_GET['Email'];

$sql = "Select * From user_account Where otp = '$code' and email = '$email'";
$result = mysqli_query($con,$sql);
if(mysqli_num_rows($result) > 0)
{
    $sql = "Update user_account set verification_status = 'true', otp = 0 Where otp = '$code' and email = '$email'";
    mysqli_query($con,$sql);
    header("location:index.php");
}
else{
    $_GET['error'] = "INVALID CODE";
}
}
ob_end_flush();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'header.php'; ?>
    <link rel="stylesheet" href="style/verify.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>VERIFY YOUR ACCOUNT</h1>
        </div>
        <div class="message">
            <p class="verify-message">VERIFICATION CODE IS SENT TO YOUR EMAIL</p>
            <p class="sent-email" name="sent-email"><?php if(isset($_GET['Email'])){echo $_GET['Email'];}?></p>
            <p class="error"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
        </div>
        <div class="form">  
        <form action="" method="POST">
            <input class="code" type="text" name="code" placeholder="ENTER VERIFICATION CODE" required>
            <div class="button">
                <button class="submit" type="submit" name="submit-code">SUBMIT</button>
            </div>
        </form>
        </div>
    </div>
    <div class="resend">
            <a class="resendlink" href="resend-otp.php?Email=<?php if(isset($_GET['Email'])){echo $_GET['Email'];}?>">RESEND VERIFICATION CODE</a>
    </div>
</body>
</html>