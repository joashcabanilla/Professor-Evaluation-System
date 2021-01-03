<?php
ob_start();
session_start();
require_once('database-config.php');
include 'functions.php';
if(isset($_POST['login']))
{
$query = "Select * from user_account Where username = '".$_POST['username']."' and password = '".$_POST['password']."'";
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result) > 0)
{
    setcookie("ERROR","");
    while($row = mysqli_fetch_assoc($result))
    {
        $_SESSION['User'] = $_POST['username'];
        if($row["account_type"] == "professor")
        {
            $_SESSION['account'] = 'professor';
            header("location:professor-page.php");
            remember_account();
        }
        elseif($row["account_type"] == "admin")
        {
            $_SESSION['account'] = 'admin';
            header("location:admin-page.php");
            remember_account();
        }
        else
        {
            $_SESSION['account'] = 'student';
            header("location:student-page.php");
            remember_account();
        }
    }
}
else
{
    header("location:index.php");
    setcookie("ERROR","Incorrect Username or Password",time()+3600);
}
}
ob_end_flush();
