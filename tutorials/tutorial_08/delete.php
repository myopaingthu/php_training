<?php

// Check parameter included in url.
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
// Check user is submitted
if (isset($_POST['submit'])) {
    // Delete user.
    try {
        // Include database connection
        include 'database/database.php';
        // Delete query
        $query = "DELETE FROM tutorial8.users WHERE id = ?";
        $stmt = $con->prepare($query);
        $stmt->bindParam(1, $id);
        // Execute the query
        if ($stmt->execute()) {
            session_start();
            $_SESSION['success'] = "User deleted successfully.";
            header("location:index.php");
        } else {
            echo "<div class='alert alert-danger'>Unable to delete record. Please try again.</div>";
        }
    }
    // Catch error
    catch (PDOException $exception) {
        die('ERROR: ' . $exception->getMessage());
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete | Tutorial 8</title>
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
    <div class="container mt-5">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
            <div class="card mx-auto">
                <div class="card-header">Delete Confirmation</div>
                <div class="card-body">
                    <p>Are you sure want to delete?</p>
                    <input type='submit' value='Delete' name="submit" class='btn btn-danger' />
                    <a href='index.php' class='btn btn-primary'>Cancel</a>
                </div>
            </div>
        </form>
    </div><!-- /.container -->
</body>

</html>