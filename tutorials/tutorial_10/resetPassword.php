<?php

session_start();

// Check user is already logged in.
if (isset($_SESSION['loggedin'])) {
    header("location:index.php");
}

if (isset($_GET['key']) && isset($_GET['token'])) {
    $token = $_GET['token'];
    $email = $_GET['key'];
    // Include database connection
    include 'database/database.php';
    // Select user from table
    try {
        // Select query for user
        $query = "SELECT * FROM tutorial10.users WHERE reset_link_token = ? LIMIT 0,1";
        // Prepare query for execution
        $stmt = $con->prepare($query);
        // First question mark
        $stmt->bindParam(1, $token);
        // Execute the query
        $stmt->execute();
        // Check user exist with query email.
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $curDate = date("Y-m-d H:i:s");
            if ($row['exp_date'] <= $curDate) {
                $_SESSION['success'] = "Current link is expired.";
                header("location:login.php");
            }
        } else {
            $_SESSION['success'] = "Current link is invalid.";
            header("location:login.php");
        }
    }
    // Catch if any error
    catch (PDOException $exception) {
        die('ERROR: ' . $exception->getMessage());
    }
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
    // Validate the password.
    if (empty($_POST["password"])) {
        $pwdErr = "Please input your password";
    } else {
        $password = testInput($_POST["password"]);
        //hash the password.
        $hashedPwd = md5($password);
    }
    // Validate the confirm password.
    if (empty($_POST["cpassword"]) || $_POST["password"] != $_POST["cpassword"]) {
        $cpwdErr = "Please confirm your password";
    } else {
        $cpassword = testInput($_POST["cpassword"]);
    }
    // Check input has passed validation
    if (isset($cpassword) && isset($hashedPwd) && isset($_POST["email"]) && isset($_POST["token"])) {
        $email = $_POST["email"];
        $null = null;
        // Update query to save token and expdate.
        try {
            // Include database connection
            include 'database/database.php';
            $query = "UPDATE tutorial10.users
                SET password=:password, reset_link_token=:reset_link_token, exp_date=:exp_date
                WHERE email = :email";
            // Prepare query for execution
            $stmt = $con->prepare($query);
            // Bind the parameters
            $stmt->bindParam(':password', $hashedPwd);
            $stmt->bindParam(':reset_link_token', $null);
            $stmt->bindParam(':exp_date', $null);
            $stmt->bindParam(':email', $email);
            // Execute the query

            // Check user exist with query email.
            if ($stmt->execute()) {
                session_start();
                $_SESSION['success'] = "Password changed successfully.";
                header("location:login.php");
            } else {
                echo "<div class='alert alert-danger'>Something was wrong. Please try again.</div>";
            }
        }
        // Catch if any error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
    } else {
        echo "<div class='alert alert-danger'>No token is provided.</div>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password | Tutorial 10</title>
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
        <h1>Change Your Password</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <?php
            if (isset($email) && isset($token)) { ?>
                <input type="hidden" name="email" value="<?php echo $email ?>">
                <input type="hidden" name="token" value="<?php echo $token ?>">
            <?php } ?>
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
            <div class="form-group">
                <label for="password">Confirm Password</label>
                <input type="password" class="form-control <?php if (isset($cpwdErr)) {
                    echo "is-invalid";
                }
                ?>" name='cpassword' placeholder="Confirm your password...">
                <?php
                if (isset($cpwdErr)) {
                    echo "<span class='text-danger'>{$cpwdErr}</span>";
                }
                ?>
            </div>
            <input type='submit' value='Change' name="submit" class='btn btn-primary' />
        </form>
    </div><!-- /.container -->
</body>

</html>