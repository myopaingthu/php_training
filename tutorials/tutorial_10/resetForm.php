<?php

use PHPMailer\PHPMailer\PHPMailer;

session_start();

// Check user is already logged in.
if (isset($_SESSION['loggedin'])) {
    header("location:index.php");
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
        $emailErr = "Please input your email to send reset link";
    } else {
        $email = testInput($_POST["email"]);
    }
    // Check input has passed validation
    if (isset($email)) {
        // Include database connection
        include 'database/database.php';
        // Select user from table
        try {
            // Select query for user
            $query = "SELECT * FROM tutorial10.users WHERE email = ? LIMIT 0,1";
            // Prepare query for execution
            $stmt = $con->prepare($query);
            // First question mark
            $stmt->bindParam(1, $email);
            // Execute the query
            $stmt->execute();
            // Check user exists with query email.
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Creat reset token.
                $token = md5($email) . rand(10, 9999);
                // Date format
                $expFormat = mktime(
                    date("H"),
                    date("i"),
                    date("s"),
                    date("m"),
                    date("d") + 1,
                    date("Y")
                );
                // Exp date for token.
                $expDate = date("Y-m-d H:i:s", $expFormat);
                // Check token and expdate.
                if (isset($token) && isset($expDate)) {
                    try {
                        // Update query to save token and expdate.
                        $query = "UPDATE tutorial10.users
                        SET reset_link_token=:reset_link_token, exp_date=:exp_date
                        WHERE email = :email";
                        // Prepare query for excecution
                        $stmt = $con->prepare($query);
                        // Bind the parameters
                        $stmt->bindParam(':reset_link_token', $token);
                        $stmt->bindParam(':exp_date', $expDate);
                        $stmt->bindParam(':email', $email);
                        // Execute the query
                        if ($stmt->execute()) {
                            require_once "vendor/autoload.php";
                            $link = "<a href='http://{$_SERVER['HTTP_HOST']}/resetPassword.php?key={$email}&token={$token}'>
                            Click This Link to Reset password</a>";

                            // PHPMailer Object
                            $mail = new PHPMailer(true);
                            $mail->CharSet =  "utf-8";
                            // Set smtp host
                            $mail->IsSMTP();
                            // enable SMTP authentication
                            $mail->SMTPAuth = true;
                            // set gmail address for authentication
                            $mail->Username = "your_gmail@gmail.com";
                            // set gmail password for authentication
                            $mail->Password = "your_password";
                            $mail->SMTPSecure = "ssl";
                            // sets GMAIL as the SMTP server
                            $mail->Host = "smtp.gmail.com";
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                            // set the SMTP port for the GMAIL server
                            $mail->Port = 587;
                            // from gmail address
                            $mail->From = 'your_gmail@gmail.com';
                            // from name
                            $mail->FromName = 'Tutorial 10';
                            // to gmail address and name
                            $mail->AddAddress($email, $row['name']);
                            // mail subject
                            $mail->Subject  =  'Reset Password';
                            // Send HTML or Plain Text email
                            $mail->IsHTML(true);
                            // Mail body
                            $mail->Body    = $link;
                            // Check mail is sent successfully or failed.
                            if ($mail->Send()) {
                                echo "<div class='alert alert-success'>Email is sent. Pleas check your inbox.</div>";
                            } else {
                                echo "Mail Error - >" . $mail->ErrorInfo;
                            }
                        }
                    }
                    // Catch errors
                    catch (PDOException $exception) {
                        die('ERROR: ' . $exception->getMessage());
                    }
                }
            } else {
                $emailErr = "No account found for this email";
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
    <title>Reset Password | Tutorial 10</title>
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
        <h1>Reset Password</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control <?php if (isset($emailErr)) {
                    echo "is-invalid";
                }
                ?>" name='email' placeholder="Email to send password reset link...">
                <?php
                if (isset($emailErr)) {
                    echo "<span class='text-danger'>{$emailErr}</span>";
                }
                ?>
            </div>
            <input type='submit' value='Reset' name="submit" class='btn btn-primary' />
            <a href='login.php' class='btn btn-success'>Back</a>
        </form>
    </div><!-- /.container -->
</body>

</html>