<?php
    session_start();
    $userID = $_SESSION['userID'];
    $date = date("d-M-Y");
    include('../Includes/conn.php');

    if(!empty($userID)){
        if(isset($_POST['addToCartBtn'])){
            $productName = $_POST['addToCartBtn'];
            $productData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `products` WHERE `name` = '$productName'"));
            $price = $productData['price'];
            $actionSQL = "INSERT INTO `cart`(`user`, `product`, `date`, `price`) VALUES ('$userID','$productName','$date', '$price')";
        }else if(isset($_POST['buyNowBtn'])){
            $productName = $_POST['buyNowBtn'];
            $productData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `products` WHERE `name` = '$productName'"));
            $price = $productData['price'];
            $actionSQL = "INSERT INTO `orders`(`user`, `product`, `date`, `price`) VALUES ('$userID','$productName','$date','$price')";
        }

        mysqli_query($conn, $actionSQL);
        $actionData = mysqli_fetch_assoc($actionQuery);
        header("location: ../index.php");
    }else{
        header("location: ../signin.php");
    }
?>