<?php 
    include('../Includes/conn.php');
    error_reporting(0);
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Login</title>
    <link rel="stylesheet" href="../css/main.css" type="text/css"/>
    <!-- Jquery File -->
    <script src="../JS/Jquery/jquery351.js"></script>

    <style>
        .Container{
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .Form-Container{
            width: 80%;
            min-height: 50vh;
            border: 1px solid gray;
            border-radius: 10px;
            padding: 10px;
            background-color: white;
        }

        .Togglers{
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            font-size: 1.1rem;
            margin: 20px 0;
            font-weight: bold;
        }

        .Toggler{
            min-height: 50px;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
            border-top: 3px solid white;
            cursor: pointer;
            color: var(--Primary);
        }

        .Seller-Toggler{
            border-top: 3px solid var(--Primary);
        }

        .Togglers div:hover{
            background-color: var(--Light);
            transition: 0.3s;
        }
        .Form-Container .Inner{
            text-align: center;
            width: 100%;
        }

        .Admin-Form{
            display: none;
        }

        .Form-Container input[type="email"],
        .Form-Container input[type="password"],
        .Form-Container input[type="submit"]{
            width: 100%;
            padding: 10px 20px;
            margin: 10px 0;
        }

        .Form-Container input[type="email"],
        .Form-Container input[type="password"]{
            border: 0;
            border-bottom: 2px solid var(--Primary);
        }

        .Form-Container input[type="submit"]{
            background-color: var(--Primary);
            color: white;
        }

        span{
            margin-right: 10px;
        }
    </style>

</head>
<body>
    <div class="Container">
        
        <div class="Form-Container">
            <div class="Togglers">
                <div class="Seller-Toggler Toggler">
                    Seller
                </div>
                <div class="Admin-Toggler Toggler">
                    Admin
                </div>
            </div>
            <div class="Inner">
                <div class="Seller-Form Form">
                    <form action="index.php" method="POST">
                        <p><input type="email" placeholder="Seller Email" name="userEmail"></p>
                        <p><input type="password" placeholder="Password" name="userPass"></p>
                        <p><input type="submit" value="LOG IN" name="sellerLogin" /></p>  
                    </form>
                </div>

                <div class="Admin-Form Form">
                    <form action="index.php" method="POST">
                        <p><input type="email" placeholder="Email" name="userEmail"></p>
                        <p><input type="password" placeholder="Password" name="userPass"></p>
                        <p><input type="submit" value="LOG IN" name="adminLogin" /></p>  
                    </form>
                </div>
            </div>

            <?php
                if(isset($_POST['sellerLogin']) || isset($_POST['adminLogin'])){
                   
                    $userEmail = $_POST['userEmail'];
                    $userPass = hash("sha256", $_POST['userPass']);
                    
                    if(isset($_POST['sellerLogin'])){
                        $logSQL = "SELECT * FROM `seller` WHERE `user_email` = '$userEmail' AND `user_password` = '$userPass'";
                        $logquery = mysqli_query($conn, $logSQL);
                        if(mysqli_num_rows($logquery) >= 1){
                            $_SESSION['userid'] = $userEmail;
                            header('location: sellerdashboard.php');
                        }else{
                            echo "<font color='red'>User Email or Password is incorrect.</font>";
                        }

                        
                        
                    }else if(isset($_POST['adminLogin'])){
                        $logSQL = "SELECT * FROM `admins` WHERE `user_email` = '$userEmail' AND `user_password` = '$userPass'";
                        $logquery = mysqli_query($conn, $logSQL);
                        if(mysqli_num_rows($logquery) >= 1){
                            $_SESSION['userid'] = $userEmail;
                            header('location: admindashboard.php');
                        }else{
                            echo "<font color='red'>User Email or Password is incorrect.</font>";
                        }
                    }

                   
                }   

            ?>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $(".Admin-Toggler").click(function(){
                $(".Toggler").css("border", "0");
                $(".Admin-Toggler").css("border-top", "3px solid var(--Primary)");
                $(".Form").hide();
                $(".Admin-Form").show();
            });

            $(".Seller-Toggler").click(function(){
                $(".Toggler").css("border", "0");
                $(".Seller-Toggler").css("border-top", "3px solid var(--Primary)");
                $(".Form").hide();
                $(".Seller-Form").show();
            });
        });
    </script>
</body>
</html>