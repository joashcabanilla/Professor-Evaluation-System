<?php
ob_start();
require_once('database-config.php');
if (isset($_SESSION['url'])) {
    header("Location:" . $_SESSION['url']);
}
$email = $_GET['Email'];
$otp = mt_rand(100000, 999999);
$sql = "Update user_account set otp = '$otp' Where email = '$email'";
mysqli_query($con,$sql);
mail($email, "PROFESSOR EVALUATION SYSTEM ACCOUNT VERIFICATION CODE", "USE THIS CODE TO VERIFY YOUR ACCOUNT  " . $otp);
header("location:verification.php?Email=$email");
ob_end_flush();
?>