<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<body>
<form action="BtvnBuoi1.php" method="POST">
      <label for="inputNumber1">Input Number 1</label>
      <input type="text" id="inputNumber1" required>

      <label for="inputNumber2">Input Number 2</label>
      <input type="text" id="inputNumber2" required>

      <label for="inputNumber3">Input Number 3</label>
      <input type="text" id="inputNumber3" required>

      <input type="button" value="SEND">
   </form>
   <?php 
    var_dump( $_GET);
   ?>
</body>
</html>