<?php
ob_start();
require_once('database-config.php');
if (isset($_SESSION['url'])) {
    header("Location:" . $_SESSION['url']);
}
$email = $_GET['Email'];
$fotp = mt_rand(100000, 999999);
$sql = "Update user_account set fotp = '$fotp' Where email = '$email'";
mysqli_query($con,$sql);
mail($email, "PROFESSOR EVALUATION SYSTEM ACCOUNT RECOVERY CODE", "USE THIS CODE TO RECOVER YOUR ACCOUNT  " . $fotp);
header("location:forgot-password.php?resend=true");
ob_end_flush();
?>