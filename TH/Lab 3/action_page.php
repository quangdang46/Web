<?php
if (empty($_POST['name']) || empty($_POST['email'])) {
  echo "Please fill all the fields";
} else {
  $name = $_POST['name'];
  $email = $_POST['pwd'];
  echo "Name: " . $name . " Email: " . $email;
}
