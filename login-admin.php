<?php
ob_start();
session_start();
setcookie("ERROR","");
$_SESSION['page'] = "index.php";
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
        <div>
        <div class="container" style="margin-bottom:10px;">
            <div class="csd">
                <img src="image/csd.png" alt="csd" width="380" height="200">
            </div>
            <div class="login-form" style="height:300px;">
                <form action="login.php?account=admin" method="POST">
                    <h1>Admin Login</h1>
                    <input class="username" type="text" placeholder="Username" name="username" required value="<?php if(isset($_COOKIE["login-username"])){echo $_COOKIE["login-username"];}?>">
                    <input class="password" type="password" placeholder="Password" name="password" required value="<?php if(isset($_COOKIE["login-password"])){echo $_COOKIE["login-password"];}?>">
                    <button style="margin-bottom:15px;" class="button" type="submit" name="login"> LOG IN</button></br>
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
        <a class="signup" style="font-size:20px; margin-left:490px;" href="index.php">Log In as Student/Professor</a>
    </body> 
</html>