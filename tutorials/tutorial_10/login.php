<?php

session_start();

// Check user is already logged in.
if (isset($_SESSION['loggedin'])) {
    header("location:index.php");
}

// Check for success message.
if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success'>{$_SESSION['success']}</div>";
    unset($_SESSION['success']);
}

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

// Check user is submitted
if (isset($_POST['submit'])) {
    // Validate the email.
    if (empty($_POST["email"])) {
        $emailErr = "Please input your email";
    } else {
        $email = testInput($_POST["email"]);
    }
    // Validate the password.
    if (empty($_POST["password"])) {
        $pwdErr = "Please input your password";
    } else {
        $password = testInput($_POST["password"]);
        //hash the password.
        $hashedPwd = md5($password);
    }
    // Check input has passed validation
    if (isset($email) && isset($hashedPwd)) {
        // Include database connection
        include 'database/database.php';
        // Select user from table
        try {
            // Select query for user
            $query = "SELECT name, password FROM tutorial10.users WHERE email = ? LIMIT 0,1";
            // Prepare query for execution
            $stmt = $con->prepare($query);
            // First question mark
            $stmt->bindParam(1, $email);
            // Execute the query
            $stmt->execute();
            // Check user exist with query email.
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Check password is matched.
                if ($hashedPwd == $row['password']) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['success'] = "Welcome, {$row['name']}";
                    header("location:index.php");
                } else {
                    $pwdErr = "Invalid password";
                }
            } else {
                $emailErr = "Invalid email";
            }
        }
        // Catch if any error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Tutorial 10</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/library/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/library/bootstrap.min.css">
    <link rel="stylesheet" href="css/library/bootstrap-grid.min.css">
    <script src="js/library/jquery-3.6.0.min.js"></script>
    <script src="js/library/bootstrap.bundle.min.js"></script>
    <script src="js/library/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Log In</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control <?php if (isset($emailErr)) {
                    echo "is-invalid";
                }
                ?>" name='email' placeholder="Email...">
                <?php
                if (isset($emailErr)) {
                    echo "<span class='text-danger'>{$emailErr}</span>";
                }
                ?>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control <?php if (isset($pwdErr)) {
                    echo "is-invalid";
                }
                ?>" name='password' placeholder="Password...">
                <?php
                if (isset($pwdErr)) {
                    echo "<span class='text-danger'>{$pwdErr}</span>";
                }
                ?>
            </div>
            <input type='submit' value='Login' name="submit" class='btn btn-primary' />
            <a href='resetForm.php' class='btn btn-success'>Reset Password</a>
        </form>
    </div><!-- /.container -->
</body>

</html>