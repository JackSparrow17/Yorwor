<?php
    include('Includes/conn.php');
    error_reporting(0);
     if(isset($_GET['viewStatus'])){
        session_start();
        $productName = $_GET['viewStatus'];
        $productSQL = "SELECT * FROM `products` WHERE `name` = '$productName'";
        $productQuery = mysqli_query($conn, $productSQL);
     }else{
         header('location: index.php');
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- External Stylesheets -->
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="css/home.css" type="text/css">
    <link rel="stylesheet" href="css/viewProducts.css" type="text/css">

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
        <?php include('Includes/header.php');?>

        <div class="Product-Details Wide">
            <?php 
                while($productData = mysqli_fetch_assoc($productQuery)){
                    $imagepath = "Uploads/Products/".$productData['category']."/".$productData['image'];
                    
                    echo "
                    <div class='Image Wide'>
                        <img src='".$imagepath."' />
                    </div>

                    <div class='Name-And-Price Wide'>
                        <div class='Product-Name'>".$productData['name']."</div><div class='Product-Price'>  GH&#8373;".$productData['price'].".00</div>
                    </div>

                    <form method='POST' action='Process/action.php'>
                        <div class='Action Wide'>
                            <div>
                                <button type='submit' name='addToCartBtn' value='".$productData['name']."'> Add To Cart</button>
                            </div>

                            <div>
                                <button type='submit' name='buyNowBtn' value='".$productData['name']."'> Buy Now</button>
                            </div>
                        </div>
                    </form>
                    
                    ";
                }

            ?>
        </div>
    <!-- Navigation -->
    <?php include('Includes/footer.php');?>
    </div>
</body>
</html>