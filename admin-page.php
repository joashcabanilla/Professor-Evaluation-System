<?php 
ob_start();
include 'functions.php';
validate_user('admin', 'admin-page.php');
account_admin('professor', 'student');
ob_end_flush();
?>