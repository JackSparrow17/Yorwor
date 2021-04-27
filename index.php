<?php
    include('Includes/conn.php');
    session_start();
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Yorwor | E-Commerce App </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- External Stylesheets -->
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="css/home.css" type="text/css">

    <!-- Jquery File -->
    <script src="JS/Jquery/jquery351.js"></script>
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/07b6c584d8.js"></script>


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <div class="Container Wide">
        <?php include('Includes/header.php');?>

        <!-- Product Categories -->
        <div class="Categories Wide">
            <a href="#">
                <div class="Item">
                    <p><img src="Images/Icons/car.png" /></p>
                    <p> Vehicles </p>
                </div>
            </a>

            <a href="#">
                <div class="Item">
                    <p><img src="Images/Icons/blender.png" /></p>
                    <p> Electronics </p>
                </div>
            </a>

            <a href="#">
                <div class="Item">
                    <p><img src="Images/Icons/smartphone.png" /></p>
                    <p> Phones & Tablets </p>
                </div>

            </a>
            <a href="#">   
                <div class="Item">
                    <p><img src="Images/Icons/laptop.png" /></p>
                    <p> Computers </p>
                </div>
            </a>
            <a href="#">    
                <div class="Item">
                    <p><img src="Images/Icons/sofa.png" /></p>
                    <p> Home & Furniture </p>
                </div>
            </a>

            <a href="#">
                <div class="Item">
                    <p><img src="Images/Icons/dress.png" /></p>
                    <p> Fashion </p>
                </div>
            </a>
            <a href="#">
                <div class="Item">
                    <p><img src="Images/Icons/skincare.png" /></p>
                    <p> Health & Beauty </p>
                </div>
            </a>
            <a href="#">
                <div class="Item">
                    <p><img src="Images/Icons/suitcase.png" /></p>
                    <p> Jobs </p>
                </div>
            </a>
            <a href="#">
                <div class="Item">
                    <p><img src="Images/Icons/fast-food.png" /></p>
                    <p> Supermarket </p>
                </div>   
            </a>

            <a href="#">
                <div class="Item">
                    <p><img src="Images/Icons/24-hours.png" /></p>
                    <p> Services </p>
                </div>   
            </a>
        </div>

        <!-- Recent Uploads -->
        <div class="Recent-Uploads Wide">
            <div class="Header-Text Wide">
                Top Products
            </div>

            <div class="Inner Wide">
                <?php 
                    //Products
                    $productsSQL = "SELECT * FROM `products`";
                    $productsQuery = mysqli_query($conn, $productsSQL);

                    while($productsData = mysqli_fetch_assoc($productsQuery)){
                        $imagepath = "Uploads/Products/".$productsData['category']."/".$productsData['image'];

                        echo "
                            <div class='Item'>
                                
                                <a href='viewProducts.php?viewStatus=".$productsData['name']."'>
                                <div class='Image Wide' style='background-image: url(".$imagepath.");'>
                                </div>
                                </a>
                                <a class='Flex-Center cartBtn' href='Process/action.php?cartValue=".$productsData['name']."' name='cartBtn'>
                                    <i class='fa fa-shopping-cart'></i>
                                </a>
            
                                <div class='Details Wide'>
                                    <div class='Product-Name Wide'>".$productsData['name']."</div>
                                    <div class='Product-Price Wide'> GH&#8373;".$productsData['price'].".00</div>
                                </div>
                        </div>
                        ";
                       // echo $imagepath;
                    }
                ?>
            </div>
        </div>
        
        <!-- Footer -->
        <?php include('Includes/footer.php')?>
    </div>

    
</body>
</html>