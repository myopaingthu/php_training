<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Top | Tutorial 2</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h1>Tutorial 2 Assignment</h1>
  <div style="width: 10%; margin: 0 auto;">
  <?php
  $row = 6;
  $space = $row;

  for ($i = 1; $i <= $row; $i++) {
      for ($j = 1; $j < $space; $j++) {
          echo "&nbsp;&nbsp;";
      }
      $space--;

      for ($j = 1; $j <= (2 * $i) - 1; $j++) {
          echo "*";
      }

      echo "<br>";
  }

  $space = 1;

  for ($i = 1; $i < $row; $i++) {
      for ($j = 1; $j <= $space; $j++) {
          echo "&nbsp;&nbsp;";
      }
      $space++;

      for ($j = 1; $j <= 2 * ($row - $i) - 1; $j++) {
          echo "*";
      }

      echo "<br>";
  }
  ?>
  </div>
</body>
</html>