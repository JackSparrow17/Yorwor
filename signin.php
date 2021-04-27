<?php
    include('Includes/conn.php');
    error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Sign In </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- External Stylesheets -->
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="css/signin.css" type="text/css">

    <!-- Jquery File -->
    <script src="JS/Jquery/jquery351.js"></script>
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/07b6c584d8.js"></script>


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <div class="Container">
    <a href="index.php" class="Back-Link-Actual"><span class="Back-Link"><i class="fa fa-arrow-left"></i></span></a>
        <div class="Image-Container Wide">
        
        </div>

        <div class="Form-Container">
            <div class="Header-Text Wide">
                SIGN IN
            </div>
            
            <form action="signin.php" method="POST">
                <?php
                    if(isset($_POST['login'])){
                        $userID = $_POST['userEmail'];
                        $userPswd = $_POST['userPswd'];
                        $loginSQL = "SELECT * FROM `users` WHERE `user_email` = '$userID' AND `user_password` = '$userPswd'";

                        if(mysqli_num_rows(mysqli_query($conn, $loginSQL)) >= 1){
                            session_start();
                            $_SESSION['userID'] = $userID;
                            header('location: index.php');
                        }else{
                            $msg = "<font color='red'>Email or Password is incorrect</font>";
                        }
                    }
                ?>

                <p><input type="email" placeholder="Email" name="userEmail" required /></p>
                <p><input type="password" placeholder="Password" name="userPswd" required /></p>
                <p style="text-align: right; padding: 0 10px;"><a href="#" style="color: gray; text-decoration: none;"> Forgot Password?</a></p>
                <p><?php echo $msg;?></p>
                
                <p style="margin-top: 7vh;"><input type="submit" name="login" value="SIGN IN" /></p>
                <p style="margin: 10px 0;">Dont have an account? <a href="register.php" style="color: var(---Primary);"> Register </a></p>
        
            </form>

            
        </div>

        
    </div>
</body>
</html>