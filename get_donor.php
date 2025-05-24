<?php
require_once "db.php";

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(["error" => "Missing id parameter"]);
    exit();
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM donors WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(404);
    echo json_encode(["error" => "Donor not found"]);
} else {
    $donor = $result->fetch_assoc();
    echo json_encode($donor);
}

$stmt->close();
$conn->close();
?>
