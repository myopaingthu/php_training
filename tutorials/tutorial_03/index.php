<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top | Tutorial 3</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
    if (isset($_POST['submit'])) {
        $birthdate = $_POST['birthdate'];
        $formattedDate = new DateTime($birthdate);
        $today = new DateTime();
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
    }
    ?>
</body>

</html>