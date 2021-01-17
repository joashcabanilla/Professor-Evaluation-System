<?php
ob_start();
session_start();
require_once('database-config.php');
if (isset($_SESSION['url'])) {
    header("Location:" . $_SESSION['url']);
}
if(isset($_GET['resend']))
{
    
    $_GET['div-form'] = "flex";
    $_GET['div-user'] = "none";
    $_GET['div-email'] = "none";
    $_GET['error'] = "RECOVERY CODE IS RESEND TO YOUR EMAIL ";
    $_GET['style'] = "font-family: 'Heebo', sans-serif;font-size: 15px;text-decoration: none;color: #b2d9b2;display: flex;justify-content: center;width: 320px;background: #59ac59;border-radius: 5px;margin-top: 10px;margin-bottom: 10px;";
        
}
else
{
    $_GET['div-form'] = "none";
    $_GET['div-user'] = "none";
}
if(isset($_POST['submit-email']))
{
    $email = $_POST['email'];
    $_GET['div-form'] = "none";
    $sql = "Select * from user_account where email = '$email'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0)
    {
        $fotp = mt_rand(100000, 999999);
        $sql = "Update user_account Set fotp = '$fotp' where email = '$email'";
        mysqli_query($con,$sql);
        $_GET['div-form'] = "flex";
        $_GET['div-email'] = "none";
        $_GET['div-user'] = "none";
        mail($email, "PROFESSOR EVALUATION SYSTEM ACCOUNT RECOVERY CODE", "USE THIS CODE TO RECOVER YOUR ACCOUNT  " . $fotp);
        $_GET['error'] = "RECOVERY CODE IS SENT TO YOUR EMAIL ";
        $_GET['style'] = "font-family: 'Heebo', sans-serif;font-size: 15px;text-decoration: none;color: #b2d9b2;display: flex;justify-content: center;width: 320px;background: #59ac59;border-radius: 5px;margin-top: 10px;margin-bottom: 10px;";
        $_SESSION['email'] = $email;
    }
    else
    {
        $_GET['error'] = "INVALID EMAIL";
        $_GET['email'] = $email;
        $_GET['div-form'] = "none";
        $_GET['div-user'] = "none";
        $_GET['div-email'] = "flex";
    }
}
elseif(isset($_POST['submit-code']))
{
    $fotp = $_POST['code'];
    $sql = "Select * from user_account where fotp ='$fotp'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0)
    {
        $email = $_SESSION['email'];
        $sql = "Update user_account Set fotp = '0' where email ='$email'";
        mysqli_query($con,$sql);
        $_GET['div-form'] = "none";
        $_GET['div-user'] = "flex";
        $_GET['div-email'] = "none";
        $_GET['error'] = "YOUR ACCOUNT SUCCESSFULLY RECOVERED CHANGE YOUR USERNAME AND PASSWORD";
        $_GET['style'] = "font-family: 'Heebo', sans-serif;font-size: 12px;text-decoration: none;color: #b2d9b2;display: flex;justify-content: center;width: 320px;background: #59ac59;border-radius: 5px;margin-top: 10px;margin-bottom: 10px; padding: 3px;";
    }
    else{
        $_GET['error'] = "INVALID CODE";
        $_GET['div-form'] = "flex";
        $_GET['div-user'] = "none";
        $_GET['div-email'] = "none";
    }
}
elseif(isset($_POST['submit-user']))
{
    $email = $_SESSION['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $_GET['username'] = $username;
    $_GET['password'] = $password;
    $_GET['confirmpassword'] = $confirmpassword;
    $confirmpassword = $_POST['confirmpassword'];
    $sql = "Select * from user_account where username = '$username'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);
        if($row['username'] == $username)
        {
            $_GET['error'] = "YOUR USERNAME ALREADY EXIST";
            $_GET['div-form'] = "none";
            $_GET['div-user'] = "flex";
            $_GET['div-email'] = "none";
        }
    }
    elseif($password != $confirmpassword)
    {
        $_GET['error'] = "Those passwords didn't match. Try again.";
        $_GET['div-form'] = "none";
        $_GET['div-user'] = "flex";
        $_GET['div-email'] = "none";
    }
    else
    {
        $sql = "Update user_account Set username = '$username', password = '$password' where email ='$email'";
        mysqli_query($con,$sql);
        $_GET['error'] = "YOUR ACCOUNT SUCCESSFULLY SAVED PROCEED TO LOG IN";
        $_GET['style'] = "font-family: 'Heebo', sans-serif;font-size: 12px;text-decoration: none;color: #b2d9b2;display: flex;justify-content: center;width: 320px;background: #59ac59;border-radius: 5px;margin-top: 10px;margin-bottom: 10px; padding: 3px;";
        $_GET['div-form'] = "none";
        $_GET['div-user'] = "none";
        $_GET['div-email'] = "none";
    }
}
ob_end_flush();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'header.php'; ?>
    <link rel="stylesheet" href="style/forgot.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>RECOVER YOUR ACCOUNT</h1>
        </div>
        <div class="message">
            <p class="error" style="<?php if(isset($_GET['style'])){ echo $_GET['style'];} ?>"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
        </div>
        <div class="form-email" style="display:<?php if(isset($_GET['div-email'])){echo $_GET['div-email'];}?>;">
            <form action= "" method="POST">
                <input class="email" name="email" type="text" placeholder="Enter Your Email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];}?>" required>
                <div class="button">
                    <button class="submit-email" name="submit-email">SUBMIT</button>
                </div>
            </form>
        </div>
        <div class="form-email" style="display:<?php if(isset($_GET['div-form'])){echo $_GET['div-form'];}?>;">
            <form action= "" method="POST">
                <input class="email" name="code" type="number" placeholder="Enter Code" required>
                <div class="button">
                    <button class="submit-email" name="submit-code">SUBMIT</button>
                </div>
                <div class="button">
                    <a class="login " href="resend-forgot.php?Email=<?php echo $_SESSION['email'];?>">RESEND CODE</a>
                </div>
            </form>
        </div>
        <div class="form-email" style="display:<?php if(isset($_GET['div-user'])){echo $_GET['div-user'];}?>;">
            <form action= "" method="POST">
                <div>
                <input class="email" name="username" type="text" placeholder="Enter Username" required value="<?php if(isset($_GET['username'])){echo $_GET['username'];}?>">
                </div>
                <div>
                <input class="email" name="password" type="password" placeholder="Enter Password" required value="<?php if(isset($_GET['password'])){echo $_GET['password'];}?>">
                </div>
                <div>
                <input class="email" name="confirmpassword" type="password" placeholder="Confirm Password" required value="<?php if(isset($_GET['confirmpassword'])){echo $_GET['confirmpassword'];}?>">
                </div>
                <div class="button">
                    <button class="submit-email" name="submit-user">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
    <div class="div-login">
    <a class="login" href="index.php">Click Here To Log In</a>
    </div>
</body>
</html>