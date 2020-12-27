<?php 
ob_start();
include 'functions.php';
validate_user('student', 'student-page.php');
account_student('professor', 'admin');
ob_end_flush();
?>