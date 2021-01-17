<?php
ob_start();
require_once('database-config.php');
$subject_code = $_GET['subject_code'];
$name = $_GET['name'];
$student_number = $_GET['studentnumber'];
$sql = "delete from subject_irregular where student_number = '$student_number' and subject_code = '$subject_code'";
mysqli_query($con,$sql);
header("location:student-page.php?name=$name&studentnumber=$student_number");
ob_end_flush();
?>