<?php 
ob_start();
include 'functions.php';
require_once('database-config.php');
validate_user('admin', 'admin-page.php');
account_admin('professor', 'student');
if(isset($_POST['save-date']))
{
    $newdate = $_POST['evaluation-date'];
    $date = date("m/d/Y", strtotime($newdate));
    $sql = "Update evaluation_setting set date = '$date'";
    mysqli_query($con,$sql);
}
date_default_timezone_set('Asia/Manila');
$datenow = date("m/d/Y");
$sql = "Select * from evaluation_setting";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
$date = $row['date'];
if($datenow == $date)
{
    $sql = "Update evaluation_setting set status='CLOSED'";
    mysqli_query($con,$sql);
}
else
{
    $sql = "Update evaluation_setting set status='OPEN'";
    mysqli_query($con,$sql);
}
if(isset($_POST['subject-add']))
{
    $sql ="select * from school_year";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $sy = $row['sy'];
    $sem = $row['semester'];
    $code = strtoupper($_POST['subject-code']);
    $description = strtoupper($_POST['subject-description']);
    $course = strtoupper($_POST['subject-course']);
    $year = strtoupper($_POST['subject-year']);
    $section = strtoupper($_POST['subject-section']);
    $prof = $_POST['subject-prof'];
    $class = $course." - ". $year.$section;
    $sql = "insert into subject(subject_code,description,course,professor,sy,sem) values('$code','$description','$class','$prof','$sy','$sem')";
    mysqli_query($con,$sql);
}
if(isset($_POST['logout']))
{   
session_destroy();
header("location:login-admin.php");
}
ob_end_flush();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="description" content="Professor Evaluation System">
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0">
<link rel="shortcut icon" href="image/icon.ico">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
<title>Professor Evaluation System</title>
    <link rel="stylesheet" href="style/admin.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <img src="image/csd.png" alt="csd" width="220" height="200">
            </div>
            <div>
            <form action="" method="POST">
                <div class="div-button" style="margin-top:20px;">
                    <button class="submit" type="submit" name="evaluation">EVALUATION DATE</button>
                    <button class="submit" type="submit" name="professor">PROFESSOR LOAD</button>
                    <button class="submit" type="submit" name="add-load">ADD PROFESSOR LOAD</button>
                    <button class="submit" type="submit" name="semester">SCHOOL YEAR & SEMESTER</button>
                    <button class="submit" type="submit" name="logout">LOGOUT</button>
                </div>
            </form>
            </div>
        </div>
        <div class="div-content">
            <div class="content">
                <?php
                ob_start();
                require_once('database-config.php');
                if(isset($_POST['semester']))
                {
                    ob_start();
                    $sql ="select * from school_year";
                    $result = mysqli_query($con,$sql);
                    echo "<table>
                    <tr>
                        <th style='width:400px;'>
                        SCHOOL YEAR
                        </th>
                        <th style='width:400px;'>
                        SEMESTER
                        </th>
                        <th>
                        BUTTON
                        </th>
                    </tr>
                    <tr>";
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $sy = $row['sy'];
                        $sem = $row['semester'];
                        echo"<td>$sy</td>";
                        echo"<td>$sem</td>";
                        $new_sy = explode("-",$sy);
                        echo"<td style='text-align: center;'><a class='view' href='schoolyear.php?sy_from=$new_sy[0]&sy_to=$new_sy[1]&sem=$sem'>EDIT</a></td>";
                    }
                    echo"</tr>
                    </table>";
                    ob_end_flush();
                }
                elseif(isset($_POST['evaluation']))
                {
                    ob_start();                
                    $sql ="select * from evaluation_setting";
                    $result = mysqli_query($con,$sql);
                    echo "<table>
                    <tr>
                        <th style='width:400px;'>
                        EVALUATION END DATE
                        </th>
                        <th style='width:400px;'>
                        EVALUATION STATUS
                        </th>
                    </tr>
                    <tr>";
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $date = $row['date'];
                        $status = $row['status'];
                        echo"<td>$date</td>";
                        echo"<td>$status</td>";
                    }
                    echo"</tr>
                    </table>";
                    echo "<div style='height:200px;margin-top:20px;display:flex;flex-direction:column;justify-content:center;align-items:center;'>
                            <label class='evaluation-date'>CHANGE EVALUATION END DATE</label>
                            <form action='' method='POST'>
                            <input  class='sy' style='width:300px;' name='evaluation-date' type='date' required>
                            <button style='width:100px;margin-left:20px;' name='save-date' class='submit'>SAVE</button>
                            </form>
                    </div>";
                    ob_end_flush();
                }
                elseif(isset($_POST['professor']))
                {
                    ob_start();
                    $sql ="select * from school_year";
                    $result = mysqli_query($con,$sql);
                    $row = mysqli_fetch_assoc($result);
                    $sy = $row['sy'];
                    $sem = $row['semester'];
                    echo "<div style='display:flex;justify-content:center;margin-top:10px;margin-bottom:10px;'>
                        <p class='prof-school'>SCHOOL YEAR: $sy</p>
                        <p class='prof-school' style='margin-left:20px;'>SEMESTER: $sem</p>
                    </div>";
                    echo "<table style='margin-bottom:20px;'>
                    <tr>
                        <th style='width:150px;'>
                        SUBJECT CODE
                        </th>
                        <th style='width:300px;'>
                        SUBJECT DESCRIPTION
                        </th>
                        <th style='width:150px;'>
                        CLASS
                        </th>
                        <th>
                        PROFESSOR NAME
                        </th>
                        <th style='width:100px;'>
                        BUTTON
                        </th>
                    </tr>";
                    $sql = "Select * from subject where sy = '$sy' and sem = '$sem'";
                    $result = mysqli_query($con,$sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $id = $row['id'];
                        $subject_code = $row['subject_code'];
                        $course = $row['course'];
                        $class = explode("-",$course);
                        $newcourse = $class[0];
                        $year = substr($class[1],-2,1);
                        $section = substr($class[1],strlen($class[1])-1);
                        $description = $row['description'];
                        $professor = $row['professor'];
                        $id = $row['id'];
                        echo "<tr>";
                        echo"<td>$subject_code</td>";
                        echo"<td>$description</td>";
                        echo"<td>$course</td>";
                        echo"<td>$professor</td>";
                        echo"<td><a class='view' href='edit-prof-load.php?id=$id&code=$subject_code&des=$description&course=$newcourse&year=$year&section=$section&prof=$professor'>EDIT</a></td>";
                        echo "</tr>";
                    }
                    echo"</table>";
                    ob_end_flush();
                }
                elseif(isset($_POST['add-load']))
                {
                    ob_start();
                    echo "<div style='display:flex;flex-direction:column;justify-content:center;align-items:center;margin-top:10px;'>
                            <label class='evaluation-date' style='font-size:40px;margin-bottom:20px;'>ADD PROFESSOR LOAD</label>
                            <form style='margin-top:-10px;' action='' method='POST'>
                                <label class='sy' style='font-size:20px;color:white;'>Subject Code</label><br>
                                <input class='sy'style='margin-top:1px;font-size:15px;width:300px; text-transform: uppercase;' type='text' name='subject-code' placeholder='Enter Subject Code' required><br>

                                <label class='sy' style='font-size:20px;color:white;'>Subject Description</label><br>
                                <textarea class='sy' style='margin-top:1px;text-transform: uppercase;font-size:15px;border-radius:0px;width:300px;height:40px;'name='subject-description' required></textarea><br>

                                <label class='sy' style='font-size:20px;color:white;'>Course</label><br>
                                <input class='sy'style='margin-top:1px;font-size:15px;width:300px; text-transform: uppercase;' type='text' name='subject-course' pattern='[a-zA-Z]+' title='ACCEPT LETTER ONLY' placeholder='Enter Course' required><br>

                                <label class='sy' style='font-size:20px;color:white;'>Year</label><br>
                                <select name='subject-year' class='sy' style='margin-top:1px;border-radius:0px;width:300px;font-size:15px;'>
                                <option value='1'>1ST</option>
                                <option value='2'>2ND</option>
                                <option value='3'>3RD</option>
                                <option value='4'>4TH</option>
                                </select><br>
                                
                                <label class='sy' style='font-size:20px;color:white;'>Section</label><br>
                                <input class='sy'style='margin-top:1px;font-size:15px;width:300px; text-transform: uppercase;' type='text' name='subject-section' maxlength='1' placeholder='Enter Section' pattern='[A-Za-z]' title='ACCEPT LETTER ONLY' required><br>";
                                echo "<label class='sy' style='font-size:20px;color:white;'>Professor Name</label><br>
                                    <select name='subject-prof' class='sy' style='text-transform: uppercase;margin-top:1px;border-radius:0px;width:300px;font-size:15px;'>";
                                $sql ="select * from profname";
                                $result = mysqli_query($con,$sql);
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    $prof_name = $row['name'];
                                    echo"<option value='$prof_name'>$prof_name</option>";
                                }
                                echo "</select><br>";   
                                echo "<div style='display:flex;justify-content:center;margin-top:-15px;margin-bottom:20px;'><button name='subject-add' type='submit' class='submit' style='height:40px;width:100px;'>ADD</button></div>";
                            echo"</form>
                    </div>";
                    ob_end_flush();
                }
                ob_end_flush();
                ?>
            </div>
        </div>
    </div>
</body>
</html>