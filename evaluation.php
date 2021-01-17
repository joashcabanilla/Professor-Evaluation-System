<?php 
ob_start();
require_once('database-config.php');
include 'functions.php';
validate_user('student', 'student-page.php');
account_student('professor', 'admin');
$name = $_GET['name'];
$student_number = $_GET['studentnumber'];
$id = $_GET['id'];
$course = strtoupper($_GET['course']);
$professor = strtoupper($_GET['professor']);
$subject_code = strtoupper($_GET['subject_code']);
if(isset($_POST['submit']))
{
    $item1 = $_POST['item1'];
    $item2 = $_POST['item2'];
    $item3 = $_POST['item3'];
    $item4 = $_POST['item4'];
    $item5 = $_POST['item5'];
    $item6 = $_POST['item6'];
    $item7 = $_POST['item7'];
    $item8 = $_POST['item8'];
    $item9 = $_POST['item9'];
    $item10 = $_POST['item10'];
    $item11 = $_POST['item11'];
    $item12 = $_POST['item12'];
    $item13 = $_POST['item13'];
    $item14 = $_POST['item14'];
    $item15 = $_POST['item15'];
    $comment = $_POST['comment'];
    $sql = "Insert Into evaluation(student_number,subject_code,professor,course,item1,item2,item3,item4,item5,item6,item7,item8,item9,item10,item11,item12,item13,item14,item15,comment) values('$student_number','$subject_code','$professor','$course','$item1','$item2','$item3','$item4','$item5','$item6','$item7','$item8','$item9','$item10','$item11','$item12','$item13','$item14','$item15','$comment')";
    mysqli_query($con,$sql);
    $sql1 = "select * from student where student_number = '$student_number' and status = 'IRREGULAR'";
    $result1 = mysqli_query($con,$sql1);
    if(mysqli_num_rows($result1) > 0)
    {
        header("location:student-page.php?name=$name&studentnumber=$student_number&submit-irreg-subject=yes");
    }
    else
    {
        header("location:student-page.php?name=$name&studentnumber=$student_number");
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
<body style="width:100%;height:100%;">
    <div class="container" style="width:1000px;height:100%;margin-top:50px;margin-bottom:50px;">
        <div class="header">
            <h1>Evaluate <?php echo $professor; ?></h1>
        </div>
        <div class="form" style="display: flex; justify-content: center; flex-direction:column;">
        <form action="" method="POST">
        <table>
            <tr>
                <th>
                QUESTION
                </th>
                <th>
                ANSWER
                </th>
            </tr>
            <tr>
            <td>
                <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">ACCURACY</p>
            </td>
            <td style="width:400px;">
            <div style="display:flex;justify-content:space-between;width:360px;">
            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:20px;">AGREE</p>
            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:20px;">NEUTRAL</p>
            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:20px;">DISAGREE</p>
            </div>
            </td>
            </tr>
            <tr>
            <td>
            <label class="sy" style="color:#cbcbcb;">1. The professor has enough knowledge of the subject that he/she teaches.</label>
            </td>
            <td>
                <div style="display:flex;justify-content:space-between;width:320px;margin-left:25px;">
                    <input style="height:30px;width:30px;" type="radio" name='item1' value="1" required>
                    <input style="height:30px;width:30px;" type="radio" name='item1' value="2">
                    <input style="height:30px;width:30px;" type="radio" name='item1' value="3">
                </div>
            </td>
            </tr>
            <tr>
            <td>
            <label class="sy" style="color:#cbcbcb;">2. The professor teaches correct and relevant information prior to the subject.</label>
            </td>
            <td>
                <div style="display:flex;justify-content:space-between;width:320px;margin-left:25px;">
                    <input style="height:30px;width:30px;" type="radio" name='item2' value="1" required>
                    <input style="height:30px;width:30px;" type="radio" name='item2' value="2">
                    <input style="height:30px;width:30px;" type="radio" name='item2' value="3">
                </div>
            </td>
            </tr>
            <tr>
            <td>
            <label class="sy" style="color:#cbcbcb;">3. The course description accurately described the course content.</label>
            </td>
            <td>
                <div style="display:flex;justify-content:space-between;width:320px;margin-left:25px;">
                    <input style="height:30px;width:30px;" type="radio" name='item3' value="1" required>
                    <input style="height:30px;width:30px;" type="radio" name='item3' value="2">
                    <input style="height:30px;width:30px;" type="radio" name='item3' value="3">
                </div>
            </td>
            </tr>
            <tr>
            <td>
            <label class="sy" style="color:#cbcbcb;">4. The professor gives accurate information and ideas that help the students in underlying concepts.</label>
            </td>
            <td>
                <div style="display:flex;justify-content:space-between;width:320px;margin-left:25px;">
                    <input style="height:30px;width:30px;" type="radio" name='item4' value="1" required>
                    <input style="height:30px;width:30px;" type="radio" name='item4' value="2">
                    <input style="height:30px;width:30px;" type="radio" name='item4' value="3">
                </div>
            </td>
            </tr>
            <tr>
            <td>
            <label class="sy" style="color:#cbcbcb;">5. The professor gives right and accurate grades based on data that is collected.</label>
            </td>
            <td>
                <div style="display:flex;justify-content:space-between;width:320px;margin-left:25px;">
                    <input style="height:30px;width:30px;" type="radio" name='item5' value="1" required>
                    <input style="height:30px;width:30px;" type="radio" name='item5' value="2">
                    <input style="height:30px;width:30px;" type="radio" name='item5' value="3">
                </div>
            </td>
            </tr>
            <tr>
            <td>
                <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">TIMELINESS</p>
            </td>
            <td style="width:400px;">
            <div style="display:flex;justify-content:space-between;width:360px;">
            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:20px;">AGREE</p>
            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:20px;">NEUTRAL</p>
            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:20px;">DISAGREE</p>
            </div>
            </td>
            </tr>
            <tr>
            <td>
            <label class="sy" style="color:#cbcbcb;">1. The course material handouts increased the knowledge and skill of every student in the subject matter.</label>
            </td>
            <td>
                <div style="display:flex;justify-content:space-between;width:320px;margin-left:25px;">
                    <input style="height:30px;width:30px;" type="radio" name='item6' value="1" required>
                    <input style="height:30px;width:30px;" type="radio" name='item6' value="2">
                    <input style="height:30px;width:30px;" type="radio" name='item6' value="3">
                </div>
            </td>
            </tr>
            <tr>
            <td>
            <label class="sy" style="color:#cbcbcb;">2. The professor gives enough time to complete school works such as individual and group projects.</label>
            </td>
            <td>
                <div style="display:flex;justify-content:space-between;width:320px;margin-left:25px;">
                    <input style="height:30px;width:30px;" type="radio" name='item7' value="1" required>
                    <input style="height:30px;width:30px;" type="radio" name='item7' value="2">
                    <input style="height:30px;width:30px;" type="radio" name='item7' value="3">
                </div>
            </td>
            </tr>
            <tr>
            <td>
            <label class="sy" style="color:#cbcbcb;">3.THe professor provides materials and lectures that are updated and relevant.</label>
            </td>
            <td>
                <div style="display:flex;justify-content:space-between;width:320px;margin-left:25px;">
                    <input style="height:30px;width:30px;" type="radio" name='item8' value="1" required>
                    <input style="height:30px;width:30px;" type="radio" name='item8' value="2">
                    <input style="height:30px;width:30px;" type="radio" name='item8' value="3">
                </div>
            </td>
            </tr>
            <tr>
            <td>
            <label class="sy" style="color:#cbcbcb;">4. The professor starts and ends his/her class exactly on time.</label>
            </td>
            <td>
                <div style="display:flex;justify-content:space-between;width:320px;margin-left:25px;">
                    <input style="height:30px;width:30px;" type="radio" name='item9' value="1" required>
                    <input style="height:30px;width:30px;" type="radio" name='item9' value="2">
                    <input style="height:30px;width:30px;" type="radio" name='item9' value="3">
                </div>
            </td>
            </tr>
            <tr>
            <td>
            <label class="sy" style="color:#cbcbcb;">5. The professor makes sure to update his/her record before teaching the students.</label>
            </td>
            <td>
                <div style="display:flex;justify-content:space-between;width:320px;margin-left:25px;">
                    <input style="height:30px;width:30px;" type="radio" name='item10' value="1" required>
                    <input style="height:30px;width:30px;" type="radio" name='item10' value="2">
                    <input style="height:30px;width:30px;" type="radio" name='item10' value="3">
                </div>
            </td>
            </tr>
            <tr>
            <td>
                <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">PERFORMANCE</p>
            </td>
            <td style="width:400px;">
            <div style="display:flex;justify-content:space-between;width:360px;">
            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:20px;">AGREE</p>
            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:20px;">NEUTRAL</p>
            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:20px;">DISAGREE</p>
            </div>
            </td>
            </tr>
            <tr>
            <td>
            <label class="sy" style="color:#cbcbcb;">1. The professor accepts feedback from the class whether it is positive or negative.</label>
            </td>
            <td>
                <div style="display:flex;justify-content:space-between;width:320px;margin-left:25px;">
                    <input style="height:30px;width:30px;" type="radio" name='item11' value="1" required>
                    <input style="height:30px;width:30px;" type="radio" name='item11' value="2">
                    <input style="height:30px;width:30px;" type="radio" name='item11' value="3">
                </div>
            </td>
            </tr>
            <tr>
            <td>
            <label class="sy" style="color:#cbcbcb;">2. The professor was approachable to willing to provide help.</label>
            </td>
            <td>
                <div style="display:flex;justify-content:space-between;width:320px;margin-left:25px;">
                    <input style="height:30px;width:30px;" type="radio" name='item12' value="1" required>
                    <input style="height:30px;width:30px;" type="radio" name='item12' value="2">
                    <input style="height:30px;width:30px;" type="radio" name='item12' value="3">
                </div>
            </td>
            </tr>
            <tr>
            <td>
            <label class="sy" style="color:#cbcbcb;">3. The professor makes the best use of class time.</label>
            </td>
            <td>
                <div style="display:flex;justify-content:space-between;width:320px;margin-left:25px;">
                    <input style="height:30px;width:30px;" type="radio" name='item13' value="1" required>
                    <input style="height:30px;width:30px;" type="radio" name='item13' value="2">
                    <input style="height:30px;width:30px;" type="radio" name='item13' value="3">
                </div>
            </td>
            </tr>
            <tr>
            <td>
            <label class="sy" style="color:#cbcbcb;">4. The professor speaks and uses words that are clear and easy to understand.</label>
            </td>
            <td>
                <div style="display:flex;justify-content:space-between;width:320px;margin-left:25px;">
                    <input style="height:30px;width:30px;" type="radio" name='item14' value="1" required>
                    <input style="height:30px;width:30px;" type="radio" name='item14' value="2">
                    <input style="height:30px;width:30px;" type="radio" name='item14' value="3">
                </div>
            </td>
            </tr>
            <tr>
            <td>
            <label class="sy" style="color:#cbcbcb;">5. The professor cooperates well with other teachers, the administration, and other educational personnel.</label>
            </td>
            <td>
                <div style="display:flex;justify-content:space-between;width:320px;margin-left:25px;">
                    <input style="height:30px;width:30px;" type="radio" name='item15' value="1" required>
                    <input style="height:30px;width:30px;" type="radio" name='item15' value="2">
                    <input style="height:30px;width:30px;" type="radio" name='item15' value="3">
                </div>
            </td>
            </tr>
        </table>
        <div style="margin-top:20px;">
            <label class='sy' style='font-size:20px;color:white;'>Comment</label><br>
            <textarea class='sy' style='margin-top:1px;font-size:15px;border-radius:0px;width:100%;height:100px;'name='comment' required></textarea>
        </div>
        <div style='display:flex;justify-content:center;margin-top:20px;margin-bottom:10px;'><button name='submit' type='submit' class='submit' style='height:40px;width:100px;'>SUBMIT</button></div>
        </form>
        </div>
    </div>
</body>
</html>