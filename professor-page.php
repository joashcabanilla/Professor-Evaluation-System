<?php
ob_start();
include 'functions.php';
require_once('database-config.php');
validate_user('professor', 'professor-page.php');
account_professor('student', 'admin');
$professor = $_GET['name'];
if(isset($_POST['logout']))
{
    session_destroy();
    header("location:index.php");
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
                <h1>WELCOME PROFESSOR</h1>
                <h1><?php if(isset($_GET['name'])){echo strtoupper($_GET['name']);} else{echo "professor name";}?></h1>
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
            <div class="content" style="justify-content: center; align-items:center;">
                <p class="prof-school" style="font-size: 45px;">SUMMARY OF EVALUATION</p>
                <div style="display:flex;">
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
                <div style="margin-top:20px;display:felx;flex-direction:row;">
                    <div>
                    <form action="" method="POST">
                    <label class="sy" style="color: #cbcbcb;font-weight:bold;font-size:20px;">SUBJECT CODE</label>
                        <select name="code" onchange="this.form.submit()" class='sy' style='margin-top:1px;border-radius:0px;width:250px;font-size:18px;'>
                        <option>SELECT SUBJECT CODE</option>
                        <?php
                            $sql = "select * from subject where professor = '$professor'";
                            $result = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $code = $row['subject_code'];
                                $description = $row['description'];
                                echo "<option value='$code'";
                                if(isset($_POST['code']) && $_POST['code'] == $code)
                                {
                                    echo "selected";
                                    $_GET['description'] = $description;
                                }
                                echo">$code</option>";
                            }
                        ?>
                        </select>
                    </form>
                    <label class="sy" style="color: #cbcbcb;font-weight:bold;font-size:20px;">SUBJECT DESCRIPTION</label><br>
                    <p class='sy' style='text-indent:0px;text-align:center;margin-left:10px;border-radius:0px;width:403px;height:100px;font-size:18px;background:white;'>
                    <?php if(isset($_GET['description'])){echo $_GET['description'];}?></p>
                    </div>
                </div>
                <div style="margin:20px;">
                <div style="margin-bottom:10px;">
                <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">TOTAL NUMBER OF STUDENT EVALUATED:
                <?php 
                    if(isset($_POST['code']))
                    {
                        $subject_code = $_POST['code'];
                        $professor = strtoupper($_GET['name']);
                        $sql = "select count(*) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                        $result = mysqli_query($con,$sql);
                        $row = mysqli_fetch_assoc($result);
                        $total_respond = $row['item1'];
                        echo $total_respond;
                    }
                ?>
                </p>
                </div>
                    <table>
                        <tr>
                            <th style="font-size:25px;">
                                QUESTION
                            </th>
                            <th style="font-size:25px;">
                                ANSWER
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">ACCURACY</p>
                            </td>
                            <td style="width:400px;">
                            <div style="display:flex;justify-content:space-between;width:360px;">
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">AGREE</p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">NEUTRAL</p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">DISAGREE</p>
                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <label class="sy" style="color:#cbcbcb;">1. The professor has enough knowledge of the subject that he/she teaches.</label>
                            </td>
                            <td style="width:400px;">
                            <div style="margin-left:15px;display:flex;justify-content:space-between;width:325px;">
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item1) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item1) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item1 = '1'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }   
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item1) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item1) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item1 = '2'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                        }
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item1) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item1) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item1 = '3'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }
                            ?>
                            </p>
                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <label class="sy" style="color:#cbcbcb;">2. The professor teaches correct and relevant information prior to the subject.</label>
                            </td>
                            <td style="width:400px;">
                            <div style="margin-left:15px;display:flex;justify-content:space-between;width:325px;">
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item2) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item2) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item2 = '1'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }   
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item2) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item2) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item2 = '2'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                        }
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item2) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item2) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item2 = '3'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }
                            ?>
                            </p>
                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <label class="sy" style="color:#cbcbcb;">3. The course description accurately described the course content.</label>
                            </td>
                            <td style="width:400px;">
                            <div style="margin-left:15px;display:flex;justify-content:space-between;width:325px;">
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item3) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item3) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item3 = '1'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }   
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item3) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item3) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item3 = '2'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                        }
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item2) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item2) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item2 = '3'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }
                            ?>
                            </p>
                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <label class="sy" style="color:#cbcbcb;">4. The professor gives accurate information and ideas that help the students in underlying concepts.</label>
                            </td>
                            <td style="width:400px;">
                            <div style="margin-left:15px;display:flex;justify-content:space-between;width:325px;">
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item4) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item4) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item4 = '1'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }   
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item4) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item4) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item4 = '2'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                        }
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item4) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item4) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item4 = '3'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }
                            ?>
                            </p>
                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <label class="sy" style="color:#cbcbcb;">5. The professor gives right and accurate grades based on data that is collected.</label>
                            </td>
                            <td style="width:400px;">
                            <div style="margin-left:15px;display:flex;justify-content:space-between;width:325px;">
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item5) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item5) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item5 = '1'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }   
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item5) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item5) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item5 = '2'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                        }
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item5) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item5) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item5 = '3'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }
                            ?>
                            </p>
                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">TIMELINESS</p>
                            </td>
                            <td style="width:400px;">
                            <div style="display:flex;justify-content:space-between;width:360px;">
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">AGREE</p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">NEUTRAL</p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">DISAGREE</p>
                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <label class="sy" style="color:#cbcbcb;">1. The course material handouts increased the knowledge and skill of every student in the subject matter.</label>
                            </td>
                            <td style="width:400px;">
                            <div style="margin-left:15px;display:flex;justify-content:space-between;width:325px;">
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item6) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item6) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item6 = '1'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }   
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item6) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item6) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item6 = '2'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                        }
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item6) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item6) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item6 = '3'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }
                            ?>
                            </p>
                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <label class="sy" style="color:#cbcbcb;">2. The professor gives enough time to complete school works such as individual and group projects.</label>
                            </td>
                            <td style="width:400px;">
                            <div style="margin-left:15px;display:flex;justify-content:space-between;width:325px;">
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item7) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item7) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item7 = '1'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }   
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item7) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item7) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item7 = '2'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                        }
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item7) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item7) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item7 = '3'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }
                            ?>
                            </p>
                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <label class="sy" style="color:#cbcbcb;">3.THe professor provides materials and lectures that are updated and relevant.</label>
                            </td>
                            <td style="width:400px;">
                            <div style="margin-left:15px;display:flex;justify-content:space-between;width:325px;">
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item8) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item8) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item8 = '1'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }   
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item8) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item8) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item8 = '2'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                        }
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item8) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item8) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item8 = '3'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }
                            ?>
                            </p>
                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <label class="sy" style="color:#cbcbcb;">4. The professor starts and ends his/her class exactly on time.</label>
                            </td>
                            <td style="width:400px;">
                            <div style="margin-left:15px;display:flex;justify-content:space-between;width:325px;">
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item9) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item9) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item9= '1'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }   
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item9) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item9) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item9 = '2'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                        }
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item9) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item9) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item9 = '3'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }
                            ?>
                            </p>
                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <label class="sy" style="color:#cbcbcb;">5. The professor makes sure to update his/her record before teaching the students.</label>
                            </td>
                            <td style="width:400px;">
                            <div style="margin-left:15px;display:flex;justify-content:space-between;width:325px;">
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item10) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item10) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item10= '1'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }   
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item10) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item10) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item10 = '2'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                        }
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item10) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item10) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item10 = '3'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }
                            ?>
                            </p>
                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">PERFORMANCE</p>
                            </td>
                            <td style="width:400px;">
                            <div style="display:flex;justify-content:space-between;width:360px;">
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">AGREE</p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">NEUTRAL</p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">DISAGREE</p>
                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <label class="sy" style="color:#cbcbcb;">1. The professor accepts feedback from the class whether it is positive or negative.</label>
                            </td>
                            <td style="width:400px;">
                            <div style="margin-left:15px;display:flex;justify-content:space-between;width:325px;">
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item11) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item11) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item11= '1'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }   
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item11) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item11) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item11 = '2'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                        }
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item11) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item11) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item11 = '3'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }
                            ?>
                            </p>
                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <label class="sy" style="color:#cbcbcb;">2. The professor was approachable to willing to provide help.</label>
                            </td>
                            <td style="width:400px;">
                            <div style="margin-left:15px;display:flex;justify-content:space-between;width:325px;">
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item12) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item12) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item12= '1'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }   
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item12) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item12) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item12 = '2'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                        }
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item12) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item12) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item12 = '3'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }
                            ?>
                            </p>
                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <label class="sy" style="color:#cbcbcb;">3. The professor makes the best use of class time.</label>
                            </td>
                            <td style="width:400px;">
                            <div style="margin-left:15px;display:flex;justify-content:space-between;width:325px;">
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item13) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item13) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item13= '1'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }   
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item13) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item13) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item13 = '2'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                        }
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item13) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item13) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item13 = '3'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }
                            ?>
                            </p>
                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <label class="sy" style="color:#cbcbcb;">4. The professor speaks and uses words that are clear and easy to understand.</label>
                            </td>
                            <td style="width:400px;">
                            <div style="margin-left:15px;display:flex;justify-content:space-between;width:325px;">
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item14) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item14) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item14= '1'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }   
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item14) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item14) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item14 = '2'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                        }
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item14) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item14) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item14 = '3'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }
                            ?>
                            </p>
                            </div>
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <label class="sy" style="color:#cbcbcb;">5. The professor cooperates well with other teachers, the administration, and other educational personnel.</label>
                            </td>
                            <td style="width:400px;">
                            <div style="margin-left:15px;display:flex;justify-content:space-between;width:325px;">
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item15) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item15) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item15= '1'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }   
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item15) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item15) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item15 = '2'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                        }
                            ?>
                            </p>
                            <p style="font-family: 'Oswald', sans-serif;color:#cbcbcb;font-size:25px;">
                            <?php 
                                if(isset($_POST['code']))
                                {
                                    $subject_code = $_POST['code'];
                                    $professor = strtoupper($_GET['name']);
                                    $sql = "select count(item15) AS 'item1' from evaluation where professor = '$professor' and subject_code = '$subject_code'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_respond = $row['item1'];
                                    $sql = "select count(item15) AS 'AGREE' from evaluation where professor = '$professor' and subject_code = '$subject_code' and item15 = '3'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $total_agree = $row['AGREE'];
                                    if($total_respond == 0)
                                    {
                                        echo "0%";
                                    }
                                    else
                                    {
                                        $item1_agree_percent = ($total_agree / $total_respond) * 100;
                                        echo $item1_agree_percent ."%";
                                    }
                                }
                            ?>
                            </p>
                            </div>
                            </td>
                            </tr>
                    </table>
                    <div style="margin-top:20px;">
                    <label class='sy' style='font-size:20px;color:white;'>Top 5 Comment</label><br>
                    <div>
                    <?php 
                    if(isset($_POST['code']))
                    {
                        $subject_code = $_POST['code'];
                        $professor = strtoupper($_GET['name']);            
                        $sql = "select * from evaluation where subject_code ='$subject_code' and professor = '$professor' LIMIT 5";
                        $result = mysqli_query($con,$sql);
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $comment = $row['comment'];
                            echo "<p class='sy' style='text-indent:0px;text-align:left;border-radius:0px;width:100%;height:100px;font-size:18px;background:white;'>".$comment."</p>";
                        }
                    }
                    else
                    {
                        echo "<p class='sy' style='text-indent:0px;text-align:left;border-radius:0px;width:100%;height:100px;font-size:18px;background:white;'></p>";
                    }
                    ?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>