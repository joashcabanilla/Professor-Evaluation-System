<?php
ob_start();
function validate_user($account, $url)
{
    session_start();
    if (!isset($_SESSION['User'])) {
        header("location:" . $_SESSION['page']);
    } else {
        $_SESSION['url'] = $url;
    }
}

function account_professor($user1, $user2)
{
    if ($_SESSION['account'] == $user1) {
        header("location:student-page.php");
    } elseif ($_SESSION['account'] == $user2) {
        header("location:admin-page.php");
    }
}

function account_student($user1, $user2)
{
    if ($_SESSION['account'] == $user1) {
        header("location:professor-page.php");
    } elseif ($_SESSION['account'] == $user2) {
        header("location:admin-page.php");
    }
}

function account_admin($user1, $user2)
{
    if ($_SESSION['account'] == $user1) {
        header("location:professor-page.php");
    } elseif ($_SESSION['account'] == $user2) {
        header("location:student-page.php");
    }
}

function remember_account()
{
    if (!empty($_POST["remember"])) {
        setcookie("login-username", $_POST["username"], time() + 86400);
        setcookie("login-password", $_POST["password"], time() + 86400);
    } else {
        setcookie("login-username", "");
        setcookie("login-password", "");
    }
}
ob_end_flush();
