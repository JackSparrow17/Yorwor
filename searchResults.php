<?php
    include('Includes/conn.php');
    error_reporting(0);
    if(isset($_POST['search-btn'])){
        $searchTerm = $_POST['search-word'];
        $searchCategory = strtoupper($_POST['categories']);

        if(!empty($searchCategory)){
            $searchSQL = "SELECT * FROM `products` WHERE `name` LIKE '%$searchTerm%' OR `tags` LIKE '%$searchTerm%' AND `category` = '$searchCategory'";
        }else{
            $searchSQL = "SELECT * FROM `products` WHERE `name` LIKE '%$searchTerm%'  OR `tags` LIKE '%$searchTerm%'";
        }

        $searchQuery = mysqli_query($conn, $searchSQL);
    }else{
        mysqli_close($conn);
        header('location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $searchTerm; ?></title>
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
    <div class="Container">
        <?php include('Includes/header.php');?>

        <!-- Recent Uploads -->
        <div class="Recent-Uploads Wide">
            <div class="Header-Text Wide">
                 <?php echo "Results for <font color='red'><em>".$searchTerm." (".mysqli_num_rows($searchQuery).")</em></font>";?>
            </div>

            <div class="Inner Wide">
                <?php 
                    if(mysqli_num_rows($searchQuery) > 0){
                        while($searchData = mysqli_fetch_assoc($searchQuery)){
                            $imagepath = "Uploads/Products/".$searchData['category']."/".$searchData['image'];

                            echo "
                                <div class='Item'>
                                    
                                    <a href='viewProducts.php?viewStatus=".$searchData['name']."'>
                                        <div class='Image Wide' style='background-image: url(".$imagepath.");'>
                                        </div>
                                    </a>
                                    <a class='Flex-Center cartBtn' href='index.php?cartValue=".$searchData['name']."' name='cartBtn'>
                                        <i class='fa fa-shopping-cart'></i>
                                    </a>
                
                                    <div class='Details Wide'>
                                        <div class='Product-Name Wide'>".$searchData['name']."</div>
                                        <div class='Product-Price Wide'> GH&#8373;".$searchData['price'].".00</div>
                                    </div>
                            </div>
                            ";
                        }
                    }else{
                        echo "<font color='blue'><strong><em> :( Sorry! We're Out Of Stock. Please Try Again Later.</em></strong></font>"; 
                    } 

                    
                    
                ?>
            </div>
        </div>


        <!-- Navigation -->
        <?php include('Includes/footer.php');?>
    </div>
</body>
</html>