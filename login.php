<?php
ob_start();
session_start();
require_once('database-config.php');
include 'functions.php';
if(isset($_POST['login']))
{
$query = "Select * from user_account Where username = '".$_POST['username']."' and password = '".$_POST['password']."' and verification_status = 'true'";
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result) > 0)
{
    setcookie("ERROR","");
    while($row = mysqli_fetch_assoc($result))
    {
        $name = $row['name'];
        $_SESSION['User'] = $_POST['username'];
        if($row["account_type"] == "professor")
        {
            $_SESSION['account'] = 'professor';
            header("location:professor-page.php?name=$name");
            remember_account();
        }
        elseif($row["account_type"] == "student")
        {
            $number = $row['student_number'];
            $_SESSION['account'] = 'student';
            $sql1 = "select * from subject_irregular where student_number = '$number'";
            $result1 = mysqli_query($con,$sql1);
            if(mysqli_num_rows($result1) > 0)
            {
                header("location:student-page.php?name=$name&studentnumber=$number&submit-irreg-subject=yes");
                remember_account();
            }
            else
            {
                header("location:student-page.php?name=$name&studentnumber=$number&submit-irreg-subject=no");
                remember_account();
            }

        }
        else
        {
            if($_GET['account'] == "admin")
            {
                $_SESSION['account'] = 'admin';
                header("location:admin-page.php");
            }
            else
            {
                header("location:index.php");
            }
        }
    }
}
else
{
    $sql = "Select * from user_account Where username = '".$_POST['username']."' and password = '".$_POST['password']."' and verification_status = 'false'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
        header("location:verification.php?Email=$email");
    }
    else
    {
        if($_GET['account'] == "admin")
            {
                header("location:login-admin.php");
                setcookie("ERROR","Incorrect Username or Password",time()+3600);
            }
            else
            {
                header("location:index.php");
                setcookie("ERROR","Incorrect Username or Password",time()+3600);
            }

    }

}
}
ob_end_flush();
