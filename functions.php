<?php 
ob_start();
function validate_user($account,$url)
{
session_start();
if(!isset($_SESSION['User']))
{
     header("location:index.php");
}  
else
{
     echo $_SESSION['User'];
     echo $_SESSION['account'];
     echo $account;
     $_SESSION['url'] = $url;
}
}

function account_professor($user1,$user2)
{
if($_SESSION['account'] == $user1)
{
    header("location:student-page.php");
}
elseif($_SESSION['account'] == $user2)
{
    header("location:admin-page.php");
}
}

function account_student($user1,$user2)
{
if($_SESSION['account'] == $user1)
{
    header("location:professor-page.php");
}
elseif($_SESSION['account'] == $user2)
{
    header("location:admin-page.php");
}
}

function account_admin($user1,$user2)
{
if($_SESSION['account'] == $user1)
{
    header("location:professor-page.php");
}
elseif($_SESSION['account'] == $user2)
{
    header("location:student-page.php");
}
}
ob_end_flush();
?>