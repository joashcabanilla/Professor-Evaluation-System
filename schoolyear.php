<?php 
ob_start();
include 'functions.php';
require_once('database-config.php');
validate_user('admin', 'admin-page.php');
account_admin('professor', 'student');
if(isset($_POST['submit']))
{
    $syfrom = $_POST['sy_from'];
    $syto = $_POST['sy_to'];
    $sem = $_POST['sem'];
    if(strlen($syfrom) > 4 || strlen($syto) > 4)
    {
        $_GET['error'] = "INVALID SCHOOL YEAR";
    }
    else
    {
        $sy = $syfrom."-".$syto;
        $sql = "Update school_year set sy = '$sy',semester='$sem'";
        mysqli_query($con,$sql);
        header("location:admin-page.php");

    }
}
ob_end_flush();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'header.php'; ?>
    <link rel="stylesheet" href="style/verify.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>UPDATE SCHOOL YEAR</h1>
        </div>
        <div>
        <p class="error"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
        </div>
        <div class="form" style="display: flex; justify-content: center; flex-direction:column;">
        <form action="" method="POST">
            <div>
                <div style="display: flex; justify-content: center; flex-direction:column;">
                    <div>
                        <label style="font-size: 15px;font-family: 'Heebo', sans-serif;color: #cbcbcb;">School Year From</label>
                        <input style="height:30px;font-size: 15px;font-family: 'Heebo', sans-serif;text-indent:10px;border:none;outline:none;" type="number" maxlength="4" name="sy_from" placeholder="School Year From" required value="<?php echo $_GET['sy_from'];?>">
                    </div>
                    <div style="margin-top:10px;">
                        <label style="font-size: 15px;font-family: 'Heebo', sans-serif;color: #cbcbcb;">School Year To</label>
                        <input style="height:30px;margin-left:20px;font-size: 15px;font-family: 'Heebo', sans-serif;text-indent:10px;border:none;outline:none;" type="number" maxlength="4" name="sy_to" placeholder="School Year To" required value="<?php echo $_GET['sy_to'];?>">
                    </div>
                    <div style="margin-top:10px;">
                        <label style="font-size: 15px;font-family: 'Heebo', sans-serif;color: #cbcbcb;">Semester</label>
                        <select name="sem" style="width:155px;height:30px;margin-left:55px;font-size: 15px;font-family: 'Heebo', sans-serif;text-indent:10px;border:none;outline:none;">
                            <option value="1ST"<?php if($_GET['sem'] == "1ST"){echo "selected";}?>>1ST</option>
                            <option value="2ND"<?php if($_GET['sem'] != "1ST"){echo "selected";}?>>2ND</option>
                        </select>
                    </div>
                </div>
                <div style="display: flex; justify-content: center;">
                    <button class="save" type="submit" name="submit">SAVE</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</body>
</html>