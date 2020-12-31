<?php
?>
<!DOCTYPE html>
<html>

<head>
    <?php include 'header.php'; ?>
    <link rel="stylesheet" href="style/signup-style.css">
</head>

<body>
    <div class="container">
        <div class="csd">
            <img src="image/csd.png" alt="csd" width="380" height="200">
        </div>
        <div class="create-form">
            <form action="create-account.php" method="POST">
                <h1>Create Account</h1>
                <div class="div-name">
                    <input class="name" type="text" placeholder="First Name" name="firstname" required>
                    <input class="name" type="text" placeholder="Middle Name" name="middlename" required>
                    <input class="name" type="text" placeholder="Last Name" name="lastname" required>
                </div>
            </form>
        </div>
    </div>
</body>

</html>