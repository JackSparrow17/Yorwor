<?php
    include('../Includes/conn.php');
    error_reporting(0);
    session_start();
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
            Remove Seller

            <form action="removeSeller.php" method="POST">
                <p><input type="email" name="email" placeholder="Email" /></p>
                <p><input type="submit" value="Remove" name="remSeller" />
            </form>

            <?php
                if(isset($_POST['remSeller'])){
                    $useremail = $_POST['email'];
                    $remSQL = "DELETE FROM `seller` WHERE `user_email` = '$useremail'";
                        
                    if(mysqli_query($conn, $remSQL)){
                        echo "<font color='green'> User removed successfully.</font>";
                    }else{
                        echo "<font color='red'> Sorry! An Error Occured.</font>";
                    }
                }
            ?>
        </div>
    
        
    </div>
    
</body>
</html>