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

$folder = null;
$folderErr =  null;
$successMessage = null;
$errors[] = null;

// Check user is submitted.
if (isset($_POST['submit'])) {
    // Validate the folder name.
    if (empty($_POST["folder"])) {
        $folderErr = "Folder name is required";
    } else {
        $folder = testInput($_POST["folder"]);
    }

    // Validate the image.
    if (empty($_FILES["img"]["name"])) {
        $errors[] = "File field is required";
    }

    // Check folder name and file input exist.
    if ($folder && $_FILES["img"]["name"]) {
        // Check file size bigger then 2mb.
        if (!file_exists($_FILES['img']['tmp_name'])) {
            $errors[] = 'File size must not exceeded 2 MB';
        } else {
            $location = $folder;
            // Check folder path already exist.
            if (!is_dir($location)) {
                mkdir($location, 0777);
            }
            $targetDir = $location . "/";
            $targetFile = $targetDir . basename($_FILES["img"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $extensions = ['jpeg', 'jpg', 'png'];
            // Check file type extension.
            if (in_array($imageFileType, $extensions) === false) {
                $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
            }

            // Check whether image is fake image or not.
            $check = getimagesize($_FILES["img"]["tmp_name"]);
            if ($check == false) {
                $errors[] = "Please choose real image file.";
            }

            // Check if file already exists
            if (file_exists($targetFile)) {
                $errors[] = "Sorry, file already exists.";
            }

            // Check passed all validation rules or not.
            if (count($errors) <= 1) {
                move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile);
                $successMessage = 'Successfully Uploaded!';
            }
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
    <title>Top | Tutorial 6</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
    <script src="js/library/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h1>Tutorial 6 Assignment</h1>
    <span class="success"><?php echo $successMessage; ?></span>
    <img id="preview-image-before-upload" src="">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <div class="form-control">
            <label for="img">Image</label>
            <input id="image" type="file" name="img">
            <?php
            foreach ($errors as $error) {
                echo '<span class="error">' . $error . '</span>';
            }
            ?>
        </div>
        <div class="form-control">
            <label for="folder">Folder</label>
            <input type="text" name="folder">
            <span class="error"><?php echo $folderErr; ?></span>
        </div>
        <input type="submit" name="submit" value="Save">
    </form>

    <script src="js/common.js"></script>
</body>

</html>