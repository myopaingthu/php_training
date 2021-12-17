<?php
require 'vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top | Tutorial 5</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
</head>

<body>
    <h1>Tutorial 5 Assignment</h1>
    <h2>Content of text file</h2>
    <div>
        <?php
        $txtFile = fopen('sample.txt', 'r');
        while ($line = fgets($txtFile)) {
            echo $line;
        }
        fclose($txtFile);
        ?>
    </div>

    <h2>Content of CSV file</h2>
    <div>
        <?php
        $csvFile = fopen("sample.csv", "r");
        // Check file exists.
        if ($csvFile !== FALSE) {
            while ($data = fgetcsv($csvFile)) {
                $length = count($data);
                echo '<ul>';
                for ($i = 0; $i < $length; $i++) {
                    echo '<li>' . $data[$i] . '</li>';
                }
                echo '</ul>';
            }
        }
        fclose($csvFile);
        ?>
    </div>

    <h2>Content of Excel file</h2>
    <div>
        <?php
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load("sample.xlsx");
        $sheetArray = $spreadsheet->getSheet(0)->toArray();
        $s = $spreadsheet->getSheet(0)->getStyle('C3')->getFont()->getSize();
        foreach ($sheetArray as $sheet) {
            echo '<ul>';
            foreach ($sheet as $item) {
                echo '<li style="font-size:' . $s . 'px;">' . $item . '</li>';
            }
            echo '</ul>';
        }
        ?>
    </div>

    <h2>Content of Doc file</h2>
    <div>
        <?php
        error_reporting(E_ALL ^ E_DEPRECATED);
        $dir = str_replace('\\', '/', __DIR__) . '/';
        $source = $dir . 'sample.doc';
        $phpWord = \PhpOffice\PhpWord\IOFactory::load($source);
        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                    foreach ($element->getElements() as $e) {
                        if ($e instanceof \PhpOffice\PhpWord\Element\Text) {
                            $style = $e->getFontStyle();
                            $size = $style->getSize();
                            $color = $style->getColor();
                            echo '<p style="font-size:' . $size . 'px; color: #' . $color . '">'
                                . $e->getText() . '</p>';
                        }
                    }
                }
            }
        }
        ?>
    </div>

</body>

</html>