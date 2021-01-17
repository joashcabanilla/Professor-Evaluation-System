<?php 
ob_start();
require_once('database-config.php');
include 'functions.php';
validate_user('student', 'student-page.php');
account_student('professor', 'admin');
$name = $_GET['name'];
$student_number = $_GET['studentnumber'];
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
if(isset($_POST['logout']))
{
    session_destroy();
    header("location:index.php");
}
if(isset($_POST['submit-profile']))
{
    $student_number = $_GET['studentnumber'];
    $course = strtoupper($_POST['subject-course']);
    $year = strtoupper($_POST['subject-year']);
    $section = strtoupper($_POST['subject-section']);
    $class = $course." - ". $year.$section;
    $status = strtoupper($_POST['subject-status']);
    $sql = "insert into student(student_number,status,course) values('$student_number','$status','$class')";
    mysqli_query($con,$sql);
}
if(isset($_POST['irreg-submit']))
{
    $subject_code = $_POST['irreg-subject-code'];
    $sql = "select * from subject where subject_code = '$subject_code'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $subject_code = strtoupper($row['subject_code']);
    $description = strtoupper($row['description']);
    $course = strtoupper($row['course']);
    $professor = $row['professor'];
    $sy = $row['sy'];
    $sem = $row['sem'];
    $sql ="select * from subject_irregular where student_number = '$student_number' and subject_code = '$subject_code'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0)
    {
        $_GET['error'] = "SUBJECT IS ALREADY ADDED";
    }
    else
    {
        $sql = "Insert Into subject_irregular(student_number,subject_code,description,course,professor,sy,sem) values('$student_number','$subject_code','$description','$course','$professor','$sy','$sem')";
        mysqli_query($con,$sql);
        $_GET['submit-irreg-subject'] = "no";
        $_GET['error'] = "";
    }
}
if(isset($_POST['irreg-save']))
{
    $sql = "select * from subject_irregular where student_number = '$student_number'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0)
    {
        $_GET['submit-irreg-subject'] = "yes";
    }
    else
    {
        $_GET['submit-irreg-subject'] = "no";
    }

}
ob_end_flush();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'header.php'; ?>
    <link rel="stylesheet" href="style/admin.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div style="margin-bottom: -50px;">
                <h1>WELCOME STUDENT</h1>
                <h1><?php if(isset($_GET['name'])){echo $_GET['name'];} else{echo "student name";}?></h1>
            </div>
            <div>
            <form action="" method="POST">
                <div class="div-button">
                    <button class="submit" type="submit" name="logout">LOGOUT</button>
                </div>
            </form>
            </div>
            <div style="margin-top:20px;">
                <img src="image/csd.png" alt="csd" width="200" height="100">
            </div>
        </div>
        <div class="div-content">
            <div class="content">
                <div class="profile" <?php 
                    require_once('database-config.php');
                    $student_number = $_GET['studentnumber'];
                    $sql = "select * from student where student_number = '$student_number'";
                    $result = mysqli_query($con,$sql);
                    if(mysqli_num_rows($result) > 0)
                    {
                        echo "style='display:none;'";
                    }
                    else
                    {
                        echo "style='display:flex;'";
                    }
                ?>>
                <div>
                    <h1 style="font-size:40px;">STUDENT PROFILE</h1>
                </div>
                    <form action="" method="POST">
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
                    <input class='sy'style='margin-top:1px;font-size:15px;width:300px; text-transform: uppercase;' type='text' name='subject-section' maxlength='1' placeholder='Enter Section' pattern='[A-Za-z]' title='ACCEPT LETTER ONLY' required><br>

                    <label class='sy' style='font-size:20px;color:white;'>Student Status</label><br>
                    <select name='subject-status' class='sy' style='margin-top:1px;border-radius:0px;width:300px;font-size:15px;'>
                    <option value='REGULAR'>REGULAR STUDENT</option>
                    <option value='IRREGULAR'>IRREGULAR STUDENT</option>
                    </select><br>
                    <div style='display:flex;justify-content:center;margin-top:-10px;margin-bottom:10px;'><button name='submit-profile' type='submit' class='submit' style='height:40px;width:100px;'>SUBMIT</button></div>
                    </form>
                </div>
                <div class="profile"
                <?php 
                    require_once('database-config.php');
                    $student_number = $_GET['studentnumber'];
                    $sql = "select * from student where student_number = '$student_number'";
                    $result = mysqli_query($con,$sql);
                    if(mysqli_num_rows($result) > 0)
                    {
                        $row = mysqli_fetch_assoc($result);
                        if($row['status'] == 'REGULAR')
                        {
                            echo "style='display:none;'";
                        }
                        else
                        {
                            if(isset($_GET['submit-irreg-subject']))
                            {
                                if($_GET['submit-irreg-subject'] == "no")
                                {
                                    echo "style='display:flex;'";
                                }
                                else
                                {
                                    echo "style='display:none;'";
                                }
                            }
                            else
                            {
                                echo "style='display:flex;'";
                            }
                        }
                    }
                    else
                    {
                        echo "style='display:none;'";
                    }
                ?>>
                    <div style='display:flex;justify-content:center;margin-top:10px;margin-bottom:10px;flex-direction:column;'>
                        <p class='prof-school'>IRREGULAR STUDENT ADD YOUR OWN SUBJECT</p>
                        <form action="" method="POST">
                        <div style="display: flex; justify-content:center;margin-top:20px;">
                            <label style=" margin-left:-80px;font-family: 'Heebo', sans-serif;font-size: 20px;color: #cbcbcb;">Subject Code:</label>
                            <input style="text-indent:10px;text-transform: uppercase;border:none;outline:none;width:300px;margin-right:10px;margin-left:10px;font-family: 'Heebo', sans-serif;font-size: 18px;" type="text" name="irreg-subject-code" placeholder="ENTER SUBJECT CODE" required>
                            <button type="submit" name="irreg-submit" style="width:100px;border: none;outline: none;border-radius: 15px;background-color: #a2c8d4;font-size: 20px;font-family: 'Oswald', sans-serif;color: #112140;cursor: pointer;text-align: center;">ADD</button>
                        </div>
                        </form>
                    </div>
                    <div>
                    <p class='prof-school' style="color:#ff9999; display:flex;justify-content:center;"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
                        <?php
                        $sql = "select * from subject_irregular where student_number = '$student_number'";
                        $result = mysqli_query($con,$sql);
                        echo "<table style='margin-bottom:20px;margin-top:10px;'>
                                <tr>
                                    <th style='width:150px;'>
                                    SUBJECT CODE
                                    </th>
                                    <th style='width:400px;'>
                                    SUBJECT DESCRIPTION
                                    </th>
                                    <th style='width:300px;'>
                                    CLASS
                                    </th>
                                    <th style='width:400px;'>
                                    PROFESSOR NAME
                                    </th>
                                    <th style='width:100px;'>
                                    BUTTON
                                    </th>
                                    </tr>";
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $id = $row['id'];
                            $subject_code = $row['subject_code'];
                            $course = $row['course'];
                            $description = $row['description'];
                            $professor = $row['professor'];
                            echo "<tr>";
                            echo"<td>$subject_code</td>";
                            echo"<td>$description</td>";
                            echo"<td>$course</td>";
                            echo"<td>$professor</td>";
                            echo "<td><a class='view' href='remove-subject.php?name=$name&studentnumber=$student_number&subject_code=$subject_code'>REMOVE</a></td>";
                            echo "</tr>";
                        }
                        echo"</table>";
                        ?>
                        <div style="display:flex;justify-content:center;margin-bottom:20px;">
                            <form action="" method="POST">
                                <button type="submit" name="irreg-save" style="width:200px;height:50px;margin-left:20px;width:100px;border: none;outline: none;border-radius: 15px;background-color: #a2c8d4;font-size: 20px;font-family: 'Oswald', sans-serif;color: #112140;cursor: pointer;text-align: center;">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="profile"
                <?php 
                    require_once('database-config.php');
                    $student_number = $_GET['studentnumber'];
                    $sql = "select * from student where student_number = '$student_number'";
                    $result = mysqli_query($con,$sql);
                    if(mysqli_num_rows($result) > 0)
                    {
                        $row = mysqli_fetch_assoc($result);
                        if($row['status'] == 'REGULAR')
                        {
                            echo "style='display:flex;'";
                        }
                        else
                        {
                            if(isset($_GET['submit-irreg-subject']))
                            {
                                if($_GET['submit-irreg-subject'] == "no")
                                {
                                    echo "style='display:none;'";
                                }
                                else
                                {
                                    echo "style='display:flex;'";
                                }
                            }
                            else
                            {
                                echo "style='display:none;'";
                            }
                        }
                    }
                    else
                    {
                        echo "style='display:none;'";
                    }
                ?>>
                    
                    <div style='display:flex;justify-content:center;margin-top:10px;margin-bottom:10px;'>
                        <?php 
                            $sql ="select * from school_year";
                            $result = mysqli_query($con,$sql);
                            $row = mysqli_fetch_assoc($result);
                            $sy = $row['sy'];
                            $sem = $row['semester'];
                            echo "<p class='prof-school'>SCHOOL YEAR: $sy</p>
                                    <p class='prof-school' style='margin-left:20px;'>SEMESTER: $sem</p>";
                        ?>
                    </div>
                    <div> 
                    <?php 
                            $sql ="select * from evaluation_setting";
                            $result = mysqli_query($con,$sql);
                            $row = mysqli_fetch_assoc($result);
                            $date = $row['date'];
                            $status = $row['status'];
                            if($status == 'OPEN')
                            {
                                echo "<p class='prof-school'>EVALUATION IS OPEN UNTIL $date</p>";
                            }
                            else
                            {
                                echo "<p class='prof-school'>EVALUATION IS CLOSED</p>";
                            }
                        ?>
                    </div>
                    <div>
                        <?php
                        $sql = "select * from student where student_number = $student_number";
                        $result = mysqli_query($con,$sql);
                        $row = mysqli_fetch_assoc($result);
                        $status = $row['status'];
                        $course = $row['course'];
                        if($status == 'REGULAR')
                        {
                            echo "<table style='margin-bottom:20px;margin-top:10px;'>
                                <tr>
                                    <th style='width:150px;'>
                                    SUBJECT CODE
                                    </th>
                                    <th style='width:300px;'>
                                    SUBJECT DESCRIPTION
                                    </th>
                                    <th>
                                    PROFESSOR NAME
                                    </th>
                                    <th style='width:100px;'>
                                    EVALUATE
                                    </th>
                                    </tr>";
                                    $sql = "Select * from subject where sy = '$sy' and sem = '$sem' and course = '$course'";
                                    $result = mysqli_query($con,$sql);
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        $id = $row['id'];
                                        $subject_code = $row['subject_code'];
                                        $description = $row['description'];
                                        $professor = $row['professor'];
                                        echo "<tr>";
                                        echo"<td>$subject_code</td>";
                                        echo"<td>$description</td>";
                                        echo"<td>$professor</td>";
                                        $sql2 = "select * from student where student_number = '$student_number'";
                                        $result2 = mysqli_query($con,$sql2);
                                        $row = mysqli_fetch_assoc($result2);
                                        $course = $row['course'];
                                        $sql1 ="select * from evaluation where student_number = '$student_number' and subject_code = '$subject_code' and professor = '$professor' and course = '$course'";
                                        $result1 = mysqli_query($con,$sql1);
                                        if(mysqli_num_rows($result1) > 0)
                                        {
                                            echo"<td>EVALUATED</td>";
                                        }
                                        else
                                        {
                                            $sql2 = "select * from student where student_number = '$student_number'";
                                            $result2 = mysqli_query($con,$sql2);
                                            $row = mysqli_fetch_assoc($result2);
                                            $course = $row['course'];
                                            echo"<td><a class='view' href='evaluation.php?name=$name&studentnumber=$student_number&id=$id&course=$course&professor=$professor&subject_code=$subject_code'>EVALUATE</a></td>";
                                        }
                                        echo "</tr>";
                                    }
                                    echo"</table>";
                        }
                        else
                        {
                            echo "<table style='margin-bottom:20px;margin-top:10px;'>
                                <tr>
                                    <th style='width:150px;'>
                                    SUBJECT CODE
                                    </th>
                                    <th style='width:300px;'>
                                    SUBJECT DESCRIPTION
                                    </th>
                                    <th>
                                    PROFESSOR NAME
                                    </th>
                                    <th style='width:100px;'>
                                    EVALUATE
                                    </th>
                                    </tr>";
                                    $sql = "Select * from subject_irregular where sy = '$sy' and sem = '$sem' and student_number = '$student_number'";
                                    $result = mysqli_query($con,$sql);
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        $id = $row['id'];
                                        $subject_code = $row['subject_code'];
                                        $description = $row['description'];
                                        $professor = $row['professor'];
                                        echo "<tr>";
                                        echo"<td>$subject_code</td>";
                                        echo"<td>$description</td>";
                                        echo"<td>$professor</td>";
                                        $sql2 = "select * from student where student_number = '$student_number'";
                                        $result2 = mysqli_query($con,$sql2);
                                        $row = mysqli_fetch_assoc($result2);
                                        $course = $row['course'];
                                        $sql1 ="select * from evaluation where student_number = '$student_number' and subject_code = '$subject_code' and professor = '$professor' and course = '$course'";
                                        $result1 = mysqli_query($con,$sql1);
                                        if(mysqli_num_rows($result1) > 0)
                                        {
                                            echo"<td>EVALUATED</td>";
                                        }
                                        else
                                        {
                                            $sql2 = "select * from student where student_number = '$student_number'";
                                            $result2 = mysqli_query($con,$sql2);
                                            $row = mysqli_fetch_assoc($result2);
                                            $course = $row['course'];
                                            echo"<td><a class='view' href='evaluation.php?name=$name&studentnumber=$student_number&id=$id&course=$course&professor=$professor&subject_code=$subject_code'>EVALUATE</a></td>";
                                        }
                                        echo "</tr>";
                                    }
                                    echo"</table>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>