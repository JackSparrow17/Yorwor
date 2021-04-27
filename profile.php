<?php
    include('Includes/conn.php');
    error_reporting(0);
    session_start();
    $userID = $_SESSION['userID'];

    if(!empty($userID)){
        //$userID = $_POST['userName'];
        //$userPswd = sha1($_POST['userPswd']);
        $userSQL = "SELECT * FROM `users` WHERE `user_email` = '$userID'";
        $userQuery = mysqli_query($conn, $userSQL);
        $userData = mysqli_fetch_assoc($userQuery);
    }else{
        header('location: signin.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Profile </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- External Stylesheets -->
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="css/home.css" type="text/css">
    <link rel="stylesheet" href="css/profile.css" type="text/css">

    <!-- Jquery File -->
    <script src="JS/Jquery/jquery351.js"></script>
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/07b6c584d8.js"></script>


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <a href="index.php" class="Back-Link-Actual"><span class="Back-Link"><i class="fa fa-arrow-left"></i></span></a>
    <div class="Container">
        <div class="Header Wide">
            <div class="Icon Flex-Center">
                <span id="Account"><i class="fa fa-user"></i></span> 
            </div>

            <div class="User-Name">
                <?php echo $userData['fname']." ".$userData['lname'];?>
            </div>
        </div>
    </div>

    <div class="Account-Details Wide">
        <div class="Header-Text">
            Change Account Details
        </div>
        <form action="profile.php" method="POST">
        <?php
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $email = $_POST['email'];
                $city = $_POST['location'];
                $phone = $_POST['phone'];

                if(isset($_POST['changeacc'])){
                    
                    $updateSQL = "UPDATE `users` SET `fname`='$fname', `lname`='$lname', `user_email`= '$email', `phone`='$phone', `location`='$city' WHERE `user_email` = '$userID'";
                    
                    if(mysqli_query($conn, $updateSQL)){
                        $msg = "<font color='green'>Details updated successfully. Refresh.</font>";
                    }else{
                        $msg = "<font color='red'>Sorry! An error occured.</font>";
                    }
                }else if(isset($_POST['deleteAcc'])){
                    mysqli_query($conn, "DELETE FROM `users` WHERE  `user_email` = '$userID'");
                    mysqli_query($conn, "DELETE FROM `cart` WHERE `user` = '$userID'");
                    mysqli_query($conn, "DELETE FROM `orders` WHERE `user` = '$userID'");
                    header('location: register.php');
                }
            ?>
            <p><input type="text" name="fname" value="<?php echo $userData['fname'];?>"></p>
            <p><input type="text" name="lname" value="<?php echo $userData['lname'];?>"></p>
            <p><input type="text" name="location" value="<?php echo $userData['location'];?>"></p>
            <p><input type="email" name="email" value="<?php echo $userData['user_email'];?>"></p>
            <p><input type="text" name="phone" value="<?php echo $userData['phone'];?>"></p>
            <p><?php echo $msg;?></p>
            
            <p>
                <input type="submit" name="changeacc" value="Update"/>
                <input type="submit" name="deleteAcc" value="Delete Account"/>
                <a href="profile.php?logout=true" class="logoutBtn" style="position: relative; top: 2vh;background-color: red;">Log Out</a>

                <?php
                    if(isset($_GET['logout'])){
                        mysqli_close($conn);
                        unset($_SESSION['price']);
                        unset($_SESSION['userID']);
                        unset($_GET['logout']);
                        session_destroy();
                        header("location: signin.php");
                       
                    }
                ?>
            </p>
        </form>

         
    </div>
    <?php include('Includes/footer.php');?>
</body>
</html>