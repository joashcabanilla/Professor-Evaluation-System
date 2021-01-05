<?php
ob_start();
session_start();
setcookie("ERROR","");
$_SESSION['page'] = "index.php";
unset($_SESSION['email']);
if(isset($_SESSION['url']))
{
    header("Location:".$_SESSION['url']);
}
ob_end_flush();
?>
<!DOCTYPE html>
<html>
    <head>
    <?php include 'header.php'; ?>
    <link rel="stylesheet" href="style/style.css">
    </head>
    <body>
        <div class="container">
            <div class="csd">
                <img src="image/csd.png" alt="csd" width="380" height="200">
            </div>
            <div class="login-form">
                <form action="login.php" method="POST">
                    <h1>Login</h1>
                    <input class="username" type="text" placeholder="Username" name="username" required value="<?php if(isset($_COOKIE["login-username"])){echo $_COOKIE["login-username"];}?>">
                    <input class="password" type="password" placeholder="Password" name="password" required value="<?php if(isset($_COOKIE["login-password"])){echo $_COOKIE["login-password"];}?>">
                    <label class="remember-label">
                    <input class="remember" type="checkbox" name="remember" <?php if(isset($_COOKIE["login-username"])){?>checked<?php }?>>     remember me
                    </label>
                    <a class="forgot" href="forgot-password.php">Forgot Passowrd</a></br></br>
                    <button class="button" type="submit" name="login"> LOG IN</button></br>
                    <p class="signup-label">New here?<a class="signup" href="signup.php">Sign Up</a></p>
                    <p class="error-message" name="error-login">
                        <?php
                            if(isset($_COOKIE["ERROR"]))
                            {
                                echo $_COOKIE["ERROR"];
                            }
                        ?>
                    </p>
                </form>
            </div>
        </div>
    </body> 
</html>