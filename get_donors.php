<?php
require_once "db.php";

$result = $conn->query("SELECT * FROM donors ORDER BY created_at DESC");
$donors = [];

while ($row = $result->fetch_assoc()) {
    $donors[] = $row;
}

echo json_encode($donors);

$conn->close();
?>
