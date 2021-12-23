<?php

// Set response header type
header('Content-Type: application/json');
// Include database connection
include 'database/database.php';
// Select query for all data from database
$query = "SELECT created_at, COUNT(id) as count FROM tutorial9.users GROUP BY MONTH(created_at)";
$stmt = $con->prepare($query);
$stmt->execute();
// Get numbers of row
$num = $stmt->rowCount();
// Check if more than 0 record found
if ($num > 0) {
    // Fetch database columns
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $row['created_at'] = date('F' , strtotime($row['created_at']));
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode([
        'status' => 'No Data'
    ]);
}

?>