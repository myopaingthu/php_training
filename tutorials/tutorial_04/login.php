<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Tutorial 4</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    session_start();

    if (isset($_SESSION['name'])) {
        header("location:home.php");
    }

    $emailErr = null;
    $pwdErr = null;
    $nameErr =  null;
    $name = null;
    $email = null;
    $password = null;

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

    if (isset($_POST['submit'])) {
        if (empty($_POST["name"])) {
            $nameErr = " (required)";
        } else {
            $name = testInput($_POST["name"]);
        }
        if (empty($_POST["email"])) {
            $emailErr = " (required)";
        } else {
            $email = testInput($_POST["email"]);
        }
        if (empty($_POST["password"])) {
            $pwdErr = " (required)";
        } else {
            $password = testInput($_POST["password"]);
        }
        if ($name && $email && $password) {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            header("location:home.php");
        }
    }
    ?>
    <h1>Tutorial 3 Assignment</h1>
    <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="name">Name</label><span class="error"><?php echo $nameErr; ?></span>
        <input type="text" name="name" placeholder="Name...">
        <label for="email">Email</label><span class="error"><?php echo $emailErr; ?></span>
        <input type="email" name="email" placeholder="Email...">
        <label for="password">Password</label><span class="error"><?php echo $pwdErr; ?></span>
        <input type="password" name="password" placeholder="Password...">
        <input type="submit" name="submit" value="Log In">
    </form>
</body>

</html>