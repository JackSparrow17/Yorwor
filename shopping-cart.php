<?php
    include('Includes/conn.php');
   // error_reporting(0);
    session_start();
    $userID = $_SESSION['userID'];

    if(!empty($userID)){
        $cartSQL = "SELECT * FROM `cart` WHERE `user` = '$userID'";
        $cartQuery = mysqli_query($conn, $cartSQL);
    }else{
        header('location: signin.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Shopping Cart </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- External Stylesheets -->
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="css/home.css" type="text/css">
    <link rel="stylesheet" href="css/shopping-cart.css" type="text/css">

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
    <div class="Container Wide">
        <div class="Header Wide Flex-Center">
            <i class='fa fa-shopping-cart' style="margin-right: 10px;"></i> Shopping Cart
        </div>

        <div class="Contents Wide">
            <?php
                if(mysqli_num_rows($cartQuery) >= 1){
                    while($cartData = mysqli_fetch_assoc($cartQuery)){
                        $imagepath = "Uploads/Products/".$cartData['category']."/".$cartData['image'];
                        $_SESSION['price'] = $cartData['price'];
                        echo "
                        <div class='Item Wide'>
                            <div class='Image'>
                               <img src='".$imagepath."' />
                            </div>
            
                            <div class='Info'>
                                <div class='Product-Name'>".$cartData['product']."</div>
                                <div class='Product-Price'>  GH&#8373;".$cartData['price'].".00</div>
                                <div class='Product-Location'>
                                    <i class='fa fa-map-marker'></i>".$cartData['location']."
                                </div>
    
                                <div class'Buttons'>
                                    <form method='POST' action='Process/action.php'>
                                        <button type='submit' name='buyNowBtn' value='".$cartData['product']."'> Order</button>
                                        <button type='submit' name='removeItemBtn' value='".$cartData['product']."'> Delete </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                }else{
                    echo "Your cart is empty.";
                }
            ?>
            
        </div>
        <?php include('Includes/footer.php');?>
    </div>
</body>
</html>