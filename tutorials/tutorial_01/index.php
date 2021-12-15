<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top | Tutorial 1</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Tutorial 1 Assignment</h1>
    <table>
        <?php
        for ($row = 0; $row < 8; $row++) {
            echo "<tr>";
            $row_count = $row;

            for ($i = 0; $i < 8; $i++) {
                if ($row_count % 2 == 0) {
                    echo "<td class='white'></td>";
                    $row_count++;
                } else {
                    echo "<td class='black'></td>";
                    $row_count++;
                }
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>