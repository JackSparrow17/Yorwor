<?php
    include('../Includes/conn.php');
    session_start();
    error_reporting(0);
    $userID = $_SESSION['userid'];
    if(empty($userID)){
        header('location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Yorwor | Admin Dashboard </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- External Stylesheets -->
    <link rel="stylesheet" href="../css/main.css" type="text/css">
    <link rel="stylesheet" href="../css/home.css" type="text/css">
    <link rel="stylesheet" href="../css/dashboard.css" type="text/css">

    <!-- Jquery File -->
    <script src="../JS/Jquery/jquery351.js"></script>
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/07b6c584d8.js"></script>


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

    <style>
        input, form, select{
            width: 100%;
        }

        .Overview{
            display:block;
        }
    </style>
</head>

<body>
    <div class="Container Wide">
        <?php include('header.php');?>
        
        <div class="Overview">
            Add Seller

            <form action="addSeller.php" method="POST">
                <p><input type="email" name="userEmail" placeholder="Email" /></p>
                <p><input type="text" name="fname" placeholder="First Name" /></p>
                <p><input type="password" name="userPass" placeholder="Password" /></p>
                <p>
                    <select name="location">
                        <option selected> City </option>
                        <option> Tumu, Upper West </option>
                        <option> Wa, Upper West </option>
                        <option> Bolgatanga, Upper East </option>
                        <option> Navrongo, Upper East </option>
                        
                    </select>
                </p>
                <p><input type="submit" value="Add" name="addSeller" />
            </form>

            <?php
                if(isset($_POST['addSeller'])){
                    $email = $_POST['userEmail'];
                    $fname = $_POST['fname'];
                    $pswd = hash("sha256", $_POST['userPass']);
                    $loc = $_POST['location'];
                   $exSQL = "SELECT * FROM `seller` WHERE `user_email` = '$email' AND `user_password` = '$pswd'";
                    
                    if(mysqli_num_rows(mysqli_query($conn, $exSQL)) >= 1){
                        echo "<font color='red'> User already exists.</font>";
                       
                    }else{
                        $inSQL = "INSERT INTO `seller`(`user_email`, `fname`, `user_password`, `location`) VALUES ('$email','$fname','$pswd','$loc')";
                        $query = mysqli_query($conn, $inSQL);
                        echo "<font color='green'> User added successfully.</font>";
                    }
                }
            ?>
        </div>
    
        
    </div>
    
</body>
</html>