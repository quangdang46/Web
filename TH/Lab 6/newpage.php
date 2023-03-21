<?php
if (isset($_POST['btn'])) {
  $name = $_POST['name'];
  $male = $_POST['sex'];
  $browser = $_POST['browser'];
  $children = $_POST['children'];
  echo "Name :" . $name;
  echo "</br>";
  echo "Sex :" . $male;
  echo "</br>";
  echo "Browser :" . implode(",", $browser);
  echo "</br>";
  echo "Children :" . $children;
}
