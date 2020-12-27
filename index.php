<?php
ob_start();
session_start();
if(isset($_SESSION['url']))
{
    header("Location:".$_SESSION['url']);
}
ob_end_flush();
?>
<!DOCTYPE html>
<html>
<?php
include 'header.php';
?>
    <body>
        <div class="container">
            <div class="csd">
                <img src="image/csd.png" alt="csd" width="380" height="200">
            </div>
            <div class="login-form">
                <form action="login.php" method="POST">
                    <h1>Login</h1>
                    <input class="username" type="text" placeholder="Username" name="username" required>
                    <input class="password" type="password" placeholder="Password" name="password" required>
                    <label class="remember-label">
                    <input class="remember" type="checkbox" name="remember">     remember me
                    </label>
                    <a class="forgot" href="forgot-password.php">Forgot Passowrd</a></br></br>
                    <button class="button" type="submit" name="login"> LOG IN</button></br>
                    <p class="signup-label">New here?<a class="signup" href="signup.php">Sign Up</a></p>
                    <p class="error-message" name="error-login">
                        <?php
                        if(@$_GET['Error']==true)
                        {
                            echo $_GET['Error'];
                        }
                        ?>
                    </p>
                </form>
            </div>
        </div>
    </body> 
</html>