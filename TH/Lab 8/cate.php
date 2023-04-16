<?php
session_start();
$login = "";
if(isset($_SESSION['login'])) {

  if ($_SESSION['login'] == "False") {
    $login = "<p style='color: red;'>Loi</p>";
  }
}
$login = "<a class='nav-link' href='./login.php'>Username</a>";
if(isset($_SESSION['login'])) {

  if ($_SESSION['login'] == "True") {
    $username = $_SESSION['username'];
    $login = "<a class='nav-link' href='#'>$username</a>";
  }
}
?>