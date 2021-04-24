<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $dB = "Yorwor";
    $conn = mysqli_connect($host, $user, $password, $dB);
    if(!$conn){
        echo "Connection Error!";
    }
?>