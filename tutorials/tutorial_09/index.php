<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top | Tutorial 9</title>
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
        <h1>Tutorial 9 Assignment</h1>
        <a href="create.php" class="btn btn-primary mb-2">Create new user</a>
        <?php
        session_start();
        // Check for success message.
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>{$_SESSION['success']}</div>";
            session_destroy();
        }
        // Include database connection
        include 'database/database.php';
        // Select query for all data from database
        $query = "SELECT id, name, age, description, created_at FROM tutorial9.users ORDER BY id DESC";
        $stmt = $con->prepare($query);
        $stmt->execute();
        // Get numbers of row
        $num = $stmt->rowCount();
        // Check if more than 0 record found
        if ($num > 0) {
            echo "<table class='table table-hover table-bordered'>";
            echo "<tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age <a href='chart1.html' class='float-right btn btn-sm btn-success'>Chart</a></th>
            <th>Description</th>
            <th>Registered At <a href='chart2.html' class='float-right btn btn-sm btn-success'>Chart</a></th>
            <th>Action</th>
            </tr>";
            // Fetch database columns
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Extract row to column name variable
                extract($row);
                // Readable format of date
                $date = date("F jS, Y", strtotime($created_at));
                echo "<tr>
                <td>{$id}</td>
                <td>{$name}</td>
                <td>{$age}</td>
                <td>{$description}</td>
                <td>{$date}</td>
                <td>";
                echo "<a href='update.php?id={$id}' class='btn btn-warning mr-1'>Edit</a>";
                echo "<a href='delete.php?id={$id}' class='btn btn-danger'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        // If no records found
        else {
            echo "<div class='alert alert-danger'>No records found.</div>";
        }
        ?>
    </div><!-- /.container -->
</body>

</html>