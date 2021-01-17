<?php 
ob_start();
include 'functions.php';
require_once('database-config.php');
validate_user('admin', 'admin-page.php');
account_admin('professor', 'student');
if(isset($_POST['save']))
{
    $id = $_GET['id'];
    $code = strtoupper($_POST['subject-code']);
    $description = strtoupper($_POST['subject-description']);
    $course = strtoupper($_POST['subject-course']);
    $year = strtoupper($_POST['subject-year']);
    $section = strtoupper($_POST['subject-section']);
    $prof = $_POST['subject-prof'];
    $class = $course." - ". $year.$section;
    $sy = $_COOKIE['sy'];
    $sem = $_COOKIE['sem'];
    $sql = "update subject set subject_code = '$code',description = '$description',course='$class',professor = '$prof' where id = '$id'";
    mysqli_query($con,$sql);
    header("location:admin-page.php");
}
if(isset($_POST['delete']))
{
    $id = $_GET['id'];
    $sql = "delete from subject where id = '$id'";
    mysqli_query($con,$sql);
    header("location:admin-page.php");
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
    <div class="container" style="width:500px;">
        <div class="header">
            <h1>EDIT PROFESSOR LOAD</h1>
        </div>
        <div class="form" style="display: flex; justify-content: center; flex-direction:column;">
        <form action="" method="POST">
        <label class='sy' style='font-size:20px;color:white;'>Subject Code</label><br>
        <input class='sy'style='margin-top:1px;font-size:15px;width:300px; text-transform: uppercase;' type='text' name='subject-code' placeholder='Enter Subject Code' required value="<?php echo $_GET['code'];?>"><br>

        <label class='sy' style='font-size:20px;color:white;'>Subject Description</label><br>
        <textarea class='sy' style='margin-top:1px;text-transform: uppercase;font-size:15px;border-radius:0px;width:300px;height:40px;'name='subject-description' required><?php echo $_GET['des'];?></textarea><br>
        
        <label class='sy' style='font-size:20px;color:white;'>Course</label><br>
        <input class='sy'style='margin-top:1px;font-size:15px;width:300px; text-transform: uppercase;' type='text' name='subject-course' pattern='[a-zA-Z]+' title='ACCEPT LETTER ONLY' placeholder='Enter Course' required value="<?php echo rtrim($_GET['course']);?>"><br>
        <label class='sy' style='font-size:20px;color:white;'>Year</label><br>
        <select name='subject-year' class='sy' style='margin-top:1px;border-radius:0px;width:300px;font-size:15px;'>
        <option value='1' <?php if($_GET['year'] == '1'){echo "selected";}?>>1ST</option>
        <option value='2'<?php if($_GET['year'] == '2'){echo "selected";}?>>2ND</option>
        <option value='3'<?php if($_GET['year'] == '3'){echo "selected";}?>>3RD</option>
        <option value='4'<?php if($_GET['year'] == '4'){echo "selected";}?>>4TH</option>
        </select><br>

        <label class='sy' style='font-size:20px;color:white;'>Section</label><br>
        <input class='sy'style='margin-top:1px;font-size:15px;width:300px; text-transform: uppercase;' type='text' name='subject-section' maxlength='1' placeholder='Enter Section' pattern='[A-Za-z]' title='ACCEPT LETTER ONLY' required value="<?php echo $_GET['section'];?>"><br>

        <label class='sy' style='font-size:20px;color:white;'>Professor Name</label><br>
        <select name='subject-prof' class='sy' style='text-transform: uppercase;margin-top:1px;border-radius:0px;width:300px;font-size:15px;'>
        <?php
            $sql ="select * from profname";
            $result = mysqli_query($con,$sql);
            while($row = mysqli_fetch_assoc($result))
            {
                $prof_name = $row['name'];
                echo"<option value='$prof_name'";
                if($_GET['prof'] == $prof_name){echo "selected";}
                echo">$prof_name</option>";
            }
        ?>
        </select><br>
        <div style='display:flex;justify-content:center;margin-top:20px;margin-bottom:10px;'><button name='save' type='submit' class='submit' style='height:40px;width:100px;'>SAVE</button><button name='delete' type='submit' class='submit' style='margin-left:20px;height:40px;width:100px;'>DELETE</button></div>
        </form>
        </div>
    </div>
</body>
</html>