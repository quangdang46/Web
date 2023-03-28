<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Title</title>
</head>

<body>
  <style>
    /**
        Tạo thêm 2 class khác tương tự
     */

    .A {
      background-color: #9d9d9d;
      color: white;
    }

    .A:hover {
      background-color: #3c763d;
      color: yellow;
    }

    .B {
      background-color: red;
      color: black;
    }

    .B:hover {
      background-color: #2cccff;
      color: #ff6651;
    }

    .C {
      background-color: #6A5AF9;
      color: #2cccff;
    }

    .C:hover {
      background-color: #F62682;
      color: #ff6651;
    }
  </style>

  <table border="1" cellpadding="10" cellspacing="10" style="border-collapse: collapse; width: 300px; margin: auto">
    <!-- dùng php lặp n lần với các class khác nhau lặp đi lặp lại theo thứ tự -->

    <?php
    for ($i = 0; $i < 10; $i++) {
      if ($i % 3 == 0) {
        echo '<tr class="A">';
      } else if ($i % 3 == 1) {
        echo '<tr class="B">';
      } else {
        echo '<tr class="C">';
      }
      echo '<td>' . $i . '</td>';
      echo '<td>Sinh viên ' . $i . '</td>';
      echo '</tr>';
    }

    ?>
  </table>
</body>

</html>