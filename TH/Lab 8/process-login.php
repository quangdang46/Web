<?php
session_start();
require_once('db.php');
    global $conn;
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "Select * from user where user-name ='$username'and password='$password'";
        $result = mysqli_query($conn, $sql);
        echo $result;
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['login'] == "True";
            $_SESSION['username'] == $username;
            header("Location: ./index.php");
        }
        else {
            header("Location: ./login.php");
            $_SESSION['login'] == "False";
        }
    }
?>