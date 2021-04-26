<?php
    include('../Includes/conn.php');
    //error_reporting(0);
    session_start();
    $userID = $_SESSION['userID'];
    $date = date("d-M-Y");
    $id = $_SESSION['id'];
    if(is_numeric($_POST['quantity'])){
        $qty = $_POST['quantity'];
    }else{
        $qty = 1;
    }

    if(!empty($userID)){
        
        if(isset($_POST['addToCartBtn'])){
            $productName = $_POST['addToCartBtn'];
            $productData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `products` WHERE `name` = '$productName'"));
            $price = $qty * $productData['price'];
            $category = $productData['category'];
            $image = $productData['image'];
            $location = $productData['location'];
            $actionSQL = "INSERT INTO `cart`(`user`, `product`, `date`, `price`, `image`, `category`, `location`) VALUES ('$userID','$productName','$date', '$price', '$image', '$category', '$location')";
        
        }else if(!empty($_GET['cartValue'])){
            $productName = $_GET['cartValue'];
            $productData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `products` WHERE `name` = '$productName'"));
            $price = $qty * $productData['price'];
            $category = $productData['category'];
            $image = $productData['image'];
            $location = $productData['location'];
            $actionSQL = "INSERT INTO `cart`(`user`, `product`, `date`, `price`, `image`, `category`, `location`) VALUES ('$userID','$productName','$date', '$price', '$image', '$category', '$location')";
        
        }else if(isset($_POST['buyNowBtn'])){
            $productName = $_POST['buyNowBtn'];
            $productData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `products` WHERE `name` = '$productName'"));
            
            if(!empty($_SESSION['price'])){
                $price = $_SESSION['price'];
            }else if(empty($_SESSION['price'])){
                $price = $qty * $productData['price'];
            }

            if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `orders` WHERE `product` = '$productName' AND `price` = '$price'")) >= 1){
                echo "You have already ordered for this product. Call <span>+233 20 114 4293</span> to stop the delivery.";
            }else{
                $actionSQL = "INSERT INTO `orders`(`user`, `product`, `date`, `price`) VALUES ('$userID','$productName','$date','$price')";
                $removeSQL = "DELETE FROM `cart` WHERE `product` = '$productName' AND `price` = '$price' AND `id` = '$id'";
                mysqli_query($conn, $removeSQL);
                ;
            }
        }else if(isset($_POST['removeItemBtn'])){

            $productName = $_POST['removeItemBtn'];
            $removeSQL = "DELETE FROM `cart` WHERE `product` = '$productName' AND `id` = '$id'";
            mysqli_query($conn, $removeSQL);
           
        }


        unset($_SESSION['price']);
        //unset($_SESSION['id']);
        mysqli_query($conn, $actionSQL);
        header("location: ../index.php");
    }else{
        header("location: ../signin.php");
    }
?>