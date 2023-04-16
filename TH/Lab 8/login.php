<?php
session_start();
$login = "";
if(isset($_SESSION['login'])) {

  if ($_SESSION['login'] == "False") {
    $login = "<p style='color: red;'>Loi</p>";
  }
}
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Flat HTML5/CSS3 Login Form</title>
  
  
  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  <div class="login-page">
  <div class="form">
    <form class="register-form">
      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form action="process-login.php" class="login-form" method="POST">
      <input type="text" name="username" placeholder="username" />
      <input type="password" name= "password" placeholder="password"/>
      <button>login</button>
      <?php echo $login ?>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="js/index.js"></script>

</body>
</html>
