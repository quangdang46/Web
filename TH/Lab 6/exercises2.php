<!DOCTYPE html>


<?php

$ketqua = null;
$message = null;
if (isset($_POST['btn'])) {
  $sohang1 = $_POST['sohang1'];
  $sohang2 = $_POST['sohang2'];
  $pheptinh = $_POST['pheptinh'];
  if (isset($sohang1) && isset($sohang2) && isset($pheptinh)) {
    if (is_numeric($sohang1) && is_numeric($sohang2)) {
      switch ($pheptinh) {
        case 'cong':
          $ketqua = $sohang1 + $sohang2;
          break;
        case 'tru':
          $ketqua = $sohang1 - $sohang2;
          break;
        case 'nhan':
          $ketqua = $sohang1 * $sohang2;
          break;
        case 'chia':
          if ($sohang2 == 0) {
            $message = "Không thể chia cho 0";
          } else {
            $ketqua = $sohang1 / $sohang2;
          }
          break;
        default:
          $message = "Không có phép tính này";
          break;
      }
    } else {
      $message = "Chua nhap du thong tin";
    }
  }
}


?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="" method="post">
    Số hạng 1: <input type="text" name="sohang1" id="sohang1"><br>
    Số hạng 2: <input type="text" name="sohang2" id="sohang2"><br>
    <!-- ratio box -->
    <div class="">
      <input type="radio" name="pheptinh" id="pheptinh" value="cong">Cộng
      <input type="radio" name="pheptinh" id="pheptinh" value="tru">Trừ
      <input type="radio" name="pheptinh" id="pheptinh" value="nhan">Nhân
      <input type="radio" name="pheptinh" id="pheptinh" value="chia">Chia
    </div>
    <p>
      Kết quả ở đây
      <span>
        <?php
        if (!isset($message)) {
          echo $ketqua;
        }
        ?>
      </span>
    </p>
    <input type="submit" value="Xem ket qua" name="btn"></br>
    <span style="color: red">
      <?php
      if (isset($message)) {
        echo $message;
      }
      ?>
    </span>
  </form>

</body>

</html>