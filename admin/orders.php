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

        .Order-Item{
            width: 100%;
            margin: 10px;
            border: 1px solid gray;
            border-radius: 5px;
            background-color: white;
            padding: 10px;
            cursor: pointer;

        }

        button[name="orderCheck"]{
            background-color: var(--Primary);
            color: white;
            padding: 10px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="Container Wide">
        <?php include('header.php');?>
        
        <div class="Overview">
          <?php
                $orderQuery = mysqli_query($conn, "SELECT * FROM `orders` WHERE `status` = 'pending'");
                while($orderData = mysqli_fetch_assoc($orderQuery)){
                    $useremail = $orderData['user'];
                    $userData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `user_email` = '$useremail'"));
                    $product = $orderData['product'];
                    //$productData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `procucts` WHERE `name` = '$product'"));
                    echo "
                        <div class='Order-Item'>
                           <div> <span style='font-weight: bold'>Recipient: </span>".$userData['fname']."</div>
                           <div> <span style='font-weight: bold'>Contact: </span>".$userData['phone']."</div>
                           <div> <span style='font-weight: bold'>Location: </span>".$userData['location']."</div>
                           <hr style='margin: 10px 0;'></hr>
                           <div> <span style='font-weight: bold'>Product: </span>".$orderData['product']."</div>
                           <div> <span style='font-weight: bold'>Date: </span>".$orderData['date']."</div>
                           <div> <span style='font-weight: bold'>Total Cost: </span>".$orderData['price']."</div>
                           <div> <span style='font-weight: bold'>Quantity: </span>".$orderData['quantity']."</div>

                           
                           <div>
                                <form action='orders.php' method='POST'>
                                    <button type='submit' value='".$orderData['id']."' name='orderCheck'> PENDING </button>
                                </form>
                           </div>
                        </div>
                    ";
                }

                if(isset($_POST['orderCheck'])){
                    $orderID = $_POST['orderCheck'];
                    mysqli_query($conn, "UPDATE `orders` SET `status`='delivered', `admin`='$userID' WHERE `id` = '$orderID'");

                }
          ?>



        </div>
    
    </div>
    
</body>
</html>