<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="newpage.php" method="post" style="display:inline-block;border: 1px solid;padding:5px">
    Your name:</br>
    <input type="text" name="name" id="name"><br>
    Your sex:</br>
    <input type="radio" name="sex" id="sex" value="male">Male</br>
    <input type="radio" name="sex" id="sex" value="female">Female</br>
    <input type="checkbox" name="browser[]" id="internet" value="internet explorer">Internet explorer</br>
    <input type="checkbox" name="browser[]" id="firefox" value="firefox">Firefox</br>
    <input type="checkbox" name="browser[]" id="chrome" value="chrome">Chrome</br>
    How many children do you have?</br>
    <select name="children" id="children">
      <option value="0">0</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
    </select>
    <br>
    <input type="submit" value="Submit" name="btn">
  </form>
</body>

</html>