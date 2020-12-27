<?php
ob_start();
include 'functions.php';
validate_user('professor', 'professor-page.php');
account_professor('student', 'admin');
ob_end_flush();
?>