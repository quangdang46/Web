<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername, $username, $password, "shopping");
    if($conn->connect_error){
        die("Connection failed");
    }
?>