<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .square {
      width: 40px;
      height: 40px;
    }

    .message {
      margin-top: 10px;
      font-size: 2rem;
      color: green;
      background-color: chartreuse;
      border-radius: 4px;
      padding: 4px;
    }
  </style>
</head>

<body>

  <?php
  $colors = [
    "red",
    "green",
    "blue",
    "yellow",
    "orange",
    "purple",
    "pink",
    "brown",
    "black",
    "blueviolet",
  ];

  ?>
  <div class="wrapper">
    <div class="table" style="width: 400px; height: 400px; display: flex; flex-wrap: wrap">
      <?php for ($i = 0; $i < 100; $i++) { ?>
        <div class="square" style="background-color: <?=$colors[rand(0, count($colors) - 1)]?>"></div>
      <?php } ?>
    </div>
  </div>

</body>

</html>