<?php
require_once "db.php";

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(["error" => "Missing id parameter"]);
    exit();
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM donors WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Donor deleted"]);
} else {
    http_response_code(500);
    echo json_encode(["error" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
