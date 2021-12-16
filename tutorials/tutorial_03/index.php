<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top | Tutorial 3</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/library/jquery-ui.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/library/jquery-ui.theme.min.css?v=<?php echo time(); ?>">
    <script src="js/library/jquery.js"></script>
    <script src="js/library/jquery-ui.min.js"></script>
    <script src="js/common.js"></script>
</head>

<body>
    <h1>Tutorial 3 Assignment</h1>
    <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" autocomplete="off">
        <label for="birthdate">Select Your Birthday</label>
        <input id="date" type="text" name="birthdate">
        <input type="submit" name="submit" value="Caculate Age">
    </form>

    <?php
    // Check user has submitted or not.
    if (isset($_POST['submit'])) {
        $birthdate = $_POST['birthdate'];
        $formattedDate = new DateTime($birthdate);
        $today = new DateTime();
        // Check birthday is not exceeded today.
        if ($formattedDate > $today) {
            echo '<br>';
            echo '<br>';
            echo 'Please input a valid birthday.';
        }
        $age = $formattedDate->diff($today);
        echo '<br>';
        echo '<br>';
        echo '<b>Your Age : </b> ';
        echo $age->y;
        echo ' Years, ';
        echo $age->m;
        echo ' Months, ';
        echo $age->d;
        echo ' Days';
        echo '<br>';
    }
    ?>
</body>

</html>