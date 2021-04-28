<?php
    include('../Includes/conn.php');
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
</head>

<body>
    <div class="Container Wide">
        <?php include('header.php');?>

    
        <div class="Overview">
            <div class="Item">
                <div class="Label">Users</div>
                <div class="Data"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users`"))?></div>
            </div>

            <div class="Item">
                <div class="Label">Admins</div>
                <div class="Data"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `admins`"))?></div>
            </div>

            <div class="Item">
                <div class="Label">Pending Orders</div>
                <div class="Data"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `orders` WHERE `status` = 'pending'"))?></div>
            </div>

            <div class="Item">
                <div class="Label">Products</div>
                <div class="Data"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `products`"))?></div>
            </div>

            <div class="Item">
                <div class="Label">Sellers</div>
                <div class="Data"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `seller`"))?></div>
            </div>
        </div>
    </div>
    
</body>
</html>