<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update | Tutorial 8</title>
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
        <h1>Update Product</h1>
        <?php
        // Check parameter included in url.
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
        // Include database connection
        include 'database/database.php';
        // Read current record's data
        try {
            // Select query for current data
            $query = "SELECT name, description FROM tutorial8.users WHERE id = ? LIMIT 0,1";
            $stmt = $con->prepare($query);
            // First question mark
            $stmt->bindParam(1, $id);
            $stmt->execute();
            // Store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Values to fill up our form
            $displayName = $row['name'];
            $displayDescription = $row['description'];
        }
        // Catch error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
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
            // Validate the name.
            if (empty($_POST["name"])) {
                $nameErr = "Name is required";
            } else {
                $name = testInput($_POST["name"]);
            }
            // Validate the description.
            if (empty($_POST["description"])) {
                $descriptionErr = "Description is required";
            } else {
                $description = testInput($_POST["description"]);
            }
            // Check input has passed validation
            if (isset($name) && isset($description)) {
                try {
                    // Update query to save changes
                    $query = "UPDATE tutorial8.users
                        SET name=:name, description=:description
                        WHERE id = :id";
                    // Prepare query for excecution
                    $stmt = $con->prepare($query);
                    // Bind the parameters
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':id', $id);
                    // Execute the query
                    if ($stmt->execute()) {
                        session_start();
                        $_SESSION['success'] = "User updated successfully.";
                        header("location:index.php");
                    } else {
                        echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
                    }
                }
                // Catch errors
                catch (PDOException $exception) {
                    die('ERROR: ' . $exception->getMessage());
                }
            }
        }

        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control <?php if (isset($nameErr)) {
                    echo "is-invalid";
                }
                ?>" name='name' value="<?php echo htmlspecialchars($displayName, ENT_QUOTES); ?>">
                <?php
                if (isset($nameErr)) {
                    echo "<span class='text-danger'>{$nameErr}</span>";
                }
                ?>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control <?php if (isset($descriptionErr)) {
                    echo "is-invalid";
                }
                ?>" name='description' rows="3"><?php 
                echo htmlspecialchars($displayDescription, ENT_QUOTES); ?></textarea>
                <?php
                if (isset($descriptionErr)) {
                    echo "<span class='text-danger'>{$descriptionErr}</span>";
                }
                ?>
            </div>
            <input type='submit' value='Update' name="submit" class='btn btn-primary' />
            <a href='index.php' class='btn btn-danger'>Back</a>
        </form>
    </div><!-- /.container -->
</body>

</html>