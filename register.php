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

    <style>
        .Form-Container{
            height: 100vh;
            margin-top: 0;
            border-radius: 0;
            top: 0;
        }

        .Form-Container input[type="text"],
        .Form-Container input[type="email"],
        .Form-Container input[type="password"], 
        select{
            background-image: none;
            padding: 10px;
            border: 2px dotted var(--Primary);
            color: var(--Primary);
            width: 100%;
            border-radius: 20px;
            transition: 0.3s ease-in;
        }

        .Form-Container input[type="text"]:focus,
        .Form-Container input[type="email"]:focus,
        .Form-Container input[type="password"]:focus, 
        select:hover{
            border: 2px solid var(--Primary);
            transition: 0.3s ease-in;
        }

        input::placeholder{
            color: var(--Primary);
        }
    </style>
</head>

<body>
    <div class="Container">
    <a href="index.php" class="Back-Link-Actual"><span class="Back-Link"><i class="fa fa-arrow-left"></i></span></a>
        <div class="Image-Container Wide" style="display: none;">
        
        </div>
        
        <div class="Form-Container">
            <div class="Header-Text Wide">
                SIGN UP
            </div>
            
            <form action="register.php" method="POST">
            <?php
                if(isset($_POST['login'])){
                    $userID = $_POST['userEmail'];
                    $userPswd = hash('sha256', $_POST['userPswd']);
                    $confirmSQL = "SELECT * FROM `users` WHERE `user_email` = '$userID' AND `user_password` = '$userPswd'";
                    $confirmQuery = mysqli_query($conn, $confirmSQL);

                    $fname = $_POST['fname'];
                    $lname = $_POST['lname'];
                    $city = $_POST['location'];
                    $phone = $_POST['phone'];

                    if(mysqli_num_rows($confirmQuery) >= 1){
                        $msg = "<font color='red'>User already exists. Please try again using different email and password</font>";
                    }else{
                            $registerSQL = "INSERT INTO `users`(`fname`, `lname`, `user_email`, `user_password`, `phone`, `location`) VALUES ('$fname','$lname','$userID','$userPswd','$phone','$city')";

                            if(!mysqli_query($conn, $registerSQL)){
                                $msg = "<font color='red'>Sorry! An error occured</font>";
                            }else{
                                $_SESSION['userID'] = $userID;
                                session_start();
                                header('location: index.php');
                            }
                    }
                }
                ?>
                <p><input type="text" placeholder="First Name" name="fname" required /></p>
                <p><input type="text" placeholder="Last Name" name="lname" required /></p>
                <p>
                    <select name="location">
                        <option selected> City </option>
                        <option> Tumu, Upper West </option>
                        <option> Wa, Upper West </option>
                        <option> Bolgatanga, Upper East </option>
                        <option> Navrongo, Upper East </option>
                        
                    </select>
                </p>
                <p><input type="email" placeholder="Email" name="userEmail" required /></p>
                <p><input type="text" placeholder="Phone Number" name="phone" required /></p>
                <p><input type="password" placeholder="Password" name="userPswd" minlength="6" required /></p>
                <p><?php echo $msg;?></p>

                <p style="margin-top: 7vh;"><input type="submit" name="login" value="SIGN UP" /></p>
                <p style="margin: 10px 0;">Already Registered? <a href="signin.php" style="color: var(---Primary);"> Sign In </a></p>

                
            </form>

            
        </div>

        
    </div>
</body>
</html>