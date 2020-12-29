<?php 
ob_start();
include 'functions.php';
validate_user('admin', 'admin-page.php');
account_admin('professor', 'student');
ob_end_flush();
?>
<!DOCTYPE html>
<html>
<a href="logout.php">LOGOUT</a>
</html>