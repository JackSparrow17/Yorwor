<?php
    include('../Includes/conn.php');
    error_reporting(0);
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
        .Overview{
            display: block;
        }
    </style>
</head>

<body>
    <div class="Container Wide">
        <?php include('header.php');?>

    
        <div class="Overview .Content">
            <div class="Header-Text"> Upload </div>
            
            <form method="POST" action="uploadProduct.php" enctype="multipart/form-data">
                <p><input type="text" placeholder="Name of product" name="pname" required/></p>
                <p><input type="text" placeholder="Price" name="price" required/></p>
                <p><input type="text" placeholder="Brand" name="brand"/></p>
                <p>
                    <select name="location">
                        <option selected> City </option>
                        <option> Tumu, Upper West </option>
                        <option> Wa, Upper West </option>
                        <option> Bolgatanga, Upper East </option>
                        <option> Navrongo, Upper East </option>
                        
                    </select>
                </p>
                            
                <script> CKEDITOR.replace( 'pdesc' ); </script>
                <p><textarea class="wide" name="pdesc" placeholder="Decription" style="width: 95%; min-height: 100px; margin: 10px 0;"></textarea></p>
                <p><textarea class="wide" name="tags" placeholder="Tags" style="width: 95%; min-height: 100px; margin: 10px 0;"></textarea></p>
                
                <p>
                    <select name="pcategory">
                        <option selected> Choose Category </option>
                        <option> Computers </option>
                        <option> Electronics </option>
                        <option> Fashion </option>
                        <option> Health </option>
                        <option> Home </option>
                        <option> Jobs </option>
                        <option> Services </option>
                        <option> Supermarket </option>
                        <option> Vehicles </option>
                    </select>
                </p>
                <p><span class="Label"> Upload image </span><p>
                <p><input type="file" name="image" required/></p>
                <p><input type="submit" value="Upload" name="upproduct"/></p>
            </form>


            <!-- Upload Process -->
            <div class="Stats">
            <?php
    include('../includes/conn.php');

    if(isset($_POST['upproduct'])){
        $productName = strtoupper($_POST['pname']);
        $loc = strtoupper($_POST['location']);
        $brand = strtoupper($_POST['brand']);
        $postDate = date("D-M-Y");
        $text = $_POST['pdesc'];
        $tags = $_POST['tags'];
        $description = str_replace(" ", "<br />", $text);
        $category = strtoupper($_POST['pcategory']);
        $price = $_POST['price'];
        
        
        //Image upload
        $imagename = $_FILES['image']['name'];
        $imagetmpname = $_FILES['image']['tmp_name'];
        //$extension= $_FILES['image']['type'];
        $imagenewname = uniqid().".".strtolower(end(explode('.',$imagename)));
		$targetpath = "../Uploads/Products/".$category."/".$imagenewname;

        if($category != "CHOOSE CATEGORY"){
            if(move_uploaded_file($imagetmpname, $targetpath)){
                $psql = "INSERT INTO `products`(`name`, `category`, `price`, `date`, `image`, `brand`, `description`, `location`,  `tags`) 
                VALUES ('$productName','$category','$price','$postDate', '$imagenewname','$brand','$description','$loc','$tags')";
                echo "Uploaded!";

                if(!mysqli_query($conn, $psql)){
                    echo "Failed";
                }
            }else{
                echo "Failed";
            }
        }else{ 
            echo "Please choose a category";
        }
        
        
    }


    
							
?>


            </div>
            <!-- End of upload process -->
        </div>
    </div>
    
</body>
</html>