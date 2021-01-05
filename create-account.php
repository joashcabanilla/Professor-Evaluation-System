<?php
ob_start();
session_start();
require_once('database-config.php');
if (isset($_POST['signup-button'])) {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $studentnumber = $_POST['studentnumber'];
    $email = $_POST['email'];
    $username = $_POST['create-username'];
    $password = $_POST['create-password'];
    $confirmpassword = $_POST['confirm-password'];
    $name = $lastname . "," . $firstname . " " . $middlename;
    $account_type = $_COOKIE['account_type'];
    $otp = mt_rand(100000, 999999);
    $verification_status = "false";
    function error($firstname, $middlename, $lastname, $studentnumber, $email, $username, $password, $confirmpassword, $error_message)
    {
        setcookie("email-error", $error_message, time() + 3600);
        setcookie("student-button", "none");
        setcookie("input-form", "flex");
        header("location:signup.php");
        setcookie("firstname", $firstname, time() + 3600);
        setcookie("middlename", $middlename, time() + 3600);
        setcookie("lastname", $lastname, time() + 3600);
        setcookie("studentnumber", $studentnumber, time() + 3600);
        setcookie("email", $email, time() + 3600);
        setcookie("username", $username, time() + 3600);
        setcookie("password", $password, time() + 3600);
        setcookie("confirmpass", $confirmpassword, time() + 3600);
    }
    $sql = "Select * From user_account Where (email = '$email' or username = '$username')";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row["email"] == $email) {
            $error_message = "YOUR EMAIL ALREADY REGISTERED";
            error($firstname, $middlename, $lastname, $studentnumber, $email, $username, $password, $confirmpassword, $error_message);
        } elseif ($row["username"] == $username) {
            $error_message = "YOUR USERNAME ALREADY EXIST";
            error($firstname, $middlename, $lastname, $studentnumber, $email, $username, $password, $confirmpassword, $error_message);
        }
    } else {
        $domain = explode("@", $email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "YOUR EMAIL IS INVALID";
            error($firstname, $middlename, $lastname, $studentnumber, $email, $username, $password, $confirmpassword, $error_message);
        } elseif (!checkdnsrr($domain[1])) {
            $error_message = "YOUR EMAIL NOT EXIST";
            error($firstname, $middlename, $lastname, $studentnumber, $email, $username, $password, $confirmpassword, $error_message);
        } elseif ($password != $confirmpassword) {
            $error_message = "Those passwords didn't match. Try again.";
            error($firstname, $middlename, $lastname, $studentnumber, $email, $username, $password, $confirmpassword, $error_message);
        } else {
            $query = "Insert Into user_account(name,username,password,account_type,student_number,email,otp,verification_status,fotp) values('$name','$username','$password','$account_type','$studentnumber','$email','$otp','$verification_status','0')";
            mysqli_query($con, $query);
            header("location:verification.php?Email=$email");
            mail($email, "PROFESSOR EVALUATION SYSTEM ACCOUNT VERIFICATION CODE", "USE THIS CODE TO VERIFY YOUR ACCOUNT  " . $otp);
        }
    }
}
ob_end_flush();
