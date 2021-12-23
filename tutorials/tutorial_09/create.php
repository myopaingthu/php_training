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

// Check user is submitted
if (isset($_POST['submit'])) {
    // Validate the name.
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = testInput($_POST["name"]);
    }
    // Validate the age.
    if (empty($_POST["age"])) {
        $ageErr = "Age is required";
    } else {
        $age = testInput($_POST["age"]);
    }
    // Validate the description.
    if (empty($_POST["description"])) {
        $descriptionErr = "Description is required";
    } else {
        $description = testInput($_POST["description"]);
    }
    // Check input has passed validation
    if (isset($name) && isset($description) && isset($age)) {
        // Include database connection
        include 'database/database.php';
        // Insert data to table
        try {
            // Insert query for data input
            $query = "INSERT INTO tutorial9.users 
                SET name=:name, description=:description, age=:age, created_at=:created_at";
            // Prepare query for execution
            $stmt = $con->prepare($query);
            // Bind the parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':description', $description);
            $created_at = date('Y-m-d H:i:s');
            $stmt->bindParam(':created_at', $created_at);
            // Execute the query
            if ($stmt->execute()) {
                session_start();
                $_SESSION['success'] = "User created successfully.";
                header("location:index.php");
            } else {
                echo "<div class='alert alert-danger'>Unable to save record.</div>";
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
    <title>Create | Tutorial 9</title>
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
        <h1>Create Product</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control <?php if (isset($nameErr)) {
                    echo "is-invalid";
                }
                ?>" name='name' placeholder="Name...">
                <?php
                if (isset($nameErr)) {
                    echo "<span class='text-danger'>{$nameErr}</span>";
                }
                ?>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" class="form-control <?php if (isset($ageErr)) {
                    echo "is-invalid";
                }
                ?>" name='age' placeholder="Age...">
                <?php
                if (isset($ageErr)) {
                    echo "<span class='text-danger'>{$ageErr}</span>";
                }
                ?>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control <?php if (isset($descriptionErr)) {
                    echo "is-invalid";
                }
                ?>" name='description' rows="3" placeholder="Description..."></textarea>
                <?php
                if (isset($descriptionErr)) {
                    echo "<span class='text-danger'>{$descriptionErr}</span>";
                }
                ?>
            </div>
            <input type='submit' value='Save' name="submit" class='btn btn-primary' />
            <a href='index.php' class='btn btn-danger'>Back</a>
        </form>
    </div><!-- /.container -->
</body>

</html>