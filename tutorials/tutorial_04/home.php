<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top | Tutorial 3</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    session_start();
    
    // Check user is logged in or not.
    if (!isset($_SESSION['name'])) {
        header("location:login.php");
    }
    ?>
    <nav class="clearfix">
        <h2><a href="#">Assignment</a></h2>
        <a href="logout.php">Log Out</a>
    </nav>
    <h1>Welcome <?php echo $_SESSION['name'] ?></h1>
</body>

</html>