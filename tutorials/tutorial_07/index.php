<?php

/**
 * Sanitize the input
 * @param $data
 */
function testInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$inputErr = null;

// Check user is submitted
if (isset($_POST['submit'])) {
    // Validate the qr code text.
    if (empty($_POST["id"])) {
        $inputErr = " (required*)";
    } else {
        $id = testInput($_POST["id"]);
    }
    // Check input text exists.
    if (isset($id)) {
        // Load the qr library
        include 'library/phpqrcode/qrlib.php';
        // File path
        $location = $id;
        // Check directory exists with user input text.
        if (!is_dir($location)) {
            mkdir($location, 0777);
        }
        $file = $id . "/qr" . uniqid() . ".png";
        // Other parameters
        $ecc = 'H';
        $pixel_size = 10;
        $frame_size = 2;
        // Generates QR Code and Save as PNG
        QRcode::png($id, $file, $ecc, $pixel_size, $frame_size);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top | Tutorial 7</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
    <script src="js/library/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h1>Tutorial 7 Assignment</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="clearfix" method="POST">
        <label for="id">ID</label><span class="error"><?php echo $inputErr; ?></span>
        <input type="text" name="id">
        <input type="submit" name="submit" value="Save">
    </form>
    <?php
    if (isset($file)) {
        echo "<img src='" . $file . "' class='qr'>";
    }
    ?>
</body>

</html>